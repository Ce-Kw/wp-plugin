<?php

declare(strict_types=1);

namespace CEKW\WpPlugin;

use Auryn\Injector;
use CEKW\WpPlugin\Attribute\Action;
use Closure;
use CEKW\WpPlugin\Attribute\Command;
use CEKW\WpPlugin\Attribute\Filter;
use CEKW\WpPlugin\Attribute\RestRoute;
use CEKW\WpPlugin\AttributeResolver;
use CEKW\WpPlugin\CommandInterface;
use ReflectionAttribute;
use ReflectionClass;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route as AnnotationRoute;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Generator\UrlGenerator;
use WP_CLI;

/**
 * Class to initialize the framework.
 *
 * ```php
 * $plugin = new \CEKW\WpPlugin\Plugin(__FILE__);
 * $plugin
 *     ->addServices([
 *         ...
 *     ])
 *     ->bootstrap();
 * ```
 */
class Plugin
{
    protected RestRouteCollection $restRouteCollection;
    /**
     * @see RouteCollection
     */
    protected RouteCollection $routeCollection;
    /**
     * Instances of classes defined in `Plugin::addServices()`.
     */
    protected array $serviceInstances;

    public function __construct(
        /**
         * The filename of the plugin including the path.
         */
        protected string $pluginFile,
        /**
         * Injector instance that can be overriden.
         */
        protected Injector $injector = new Injector()
    ) {
        $injector->share($GLOBALS['wpdb']);
        $injector->share(ConfigFactory::create($pluginFile));

        $this->restRouteCollection = new RestRouteCollection();
        $injector->share($this->restRouteCollection);

        if (class_exists(RouteCollection::class)) {
            $this->routeCollection = new RouteCollection();
            $injector->share($this->routeCollection);
        }

        if (class_exists(RequestContext::class)) {
            $injector->prepare(RequestContext::class, function ($requestContext) {
                $requestContext->fromRequest(Request::createFromGlobals());
            });
        }

        $injector->define(DebugInjectorCommand::class, [
            ':injector' => $injector
        ]);
    }

    /**
     * Instantiates custom service classes of this plugin and prepares them for autowiring.
     */
    public function addServices(array $services): self
    {
        $internalServices = [
            DebugInjectorCommand::class,
            DebugRestRouterCommand::class,
            DebugRouterCommand::class
        ];

        $this->serviceInstances = array_map(
            fn($service) => $this->injector->make($service),
            array_merge($services, $internalServices)
        );

        return $this;
    }

     /**
     * Bootstraps the framework and sets up all the hooks. Should be the final method called.
     */
    public function bootstrap(): void
    {
        register_activation_hook($this->pluginFile, function () {
            foreach ($this->serviceInstances as $serviceInstance) {
                if ($serviceInstance instanceof SetupHookSubscriberInterface) {
                    $serviceInstance->activate();
                }
            }
        });

        register_deactivation_hook($this->pluginFile, function () {
            foreach ($this->serviceInstances as $serviceInstance) {
                if ($serviceInstance instanceof SetupHookSubscriberInterface) {
                    $serviceInstance->deactivate();
                }
            }
        });

        $this->collectRestRoutes();
        $this->registerCliCommands();

        add_action('plugins_loaded', Closure::fromCallable([$this, 'registerHooks']));
        add_action('rest_api_init', Closure::fromCallable([$this, 'registerRestRoutes']));
        add_action('init', Closure::fromCallable([$this, 'registerRoutes']));
    }

    /**
     * Returns the `UrlGenerator` for use in other plugins or themes.
     *
     * @see UrlGenerator
     */
    public function getUrlGenerator(): UrlGenerator
    {
        return $this->injector->make(UrlGenerator::class);
    }

    /**
     * Callback that registers all hooks in service classes that implement `HookSubscriberInterface`
     * and adding their hooks via `Action` or `Filter` attributes.
     *
     * @see HookSubscriberInterface
     */
    protected function registerHooks(): void
    {
        foreach ($this->serviceInstances as $serviceInstance) {
            if (!$serviceInstance instanceof HookSubscriberInterface) {
                continue;
            }

            $serviceReflection = new ReflectionClass($serviceInstance);
            $attributeResolver = new AttributeResolver(Filter::class, $serviceReflection);
            $attributeResolver->fromMethod(
                static function ($attribute, $method) use ($serviceInstance) {
                    call_user_func(
                        $attribute instanceof Action ? 'add_action' : 'add_filter',
                        $attribute->hookName,
                        [$serviceInstance, $method->name],
                        $attribute->priority,
                        $attribute->acceptedArgs,
                    );
                },
                ReflectionAttribute::IS_INSTANCEOF
            );
        }
    }

    /**
     * Collects all REST routes from service classes extending `AbstractRestController`
     * and using the `RestRoute` attribute so that they can be displayed in `DebugRestRouterCommand`.
     *
     * @see AbstractRestController
     */
    protected function collectRestRoutes(): void
    {
        foreach ($this->serviceInstances as $serviceInstance) {
            if (!$serviceInstance instanceof AbstractRestController) {
                continue;
            }

            $serviceReflection = new ReflectionClass($serviceInstance);
            $attributeResolver = new AttributeResolver(RestRoute::class, $serviceReflection);
            $attributeResolver->fromMethod(function ($attribute, $method) use ($serviceInstance) {
                $this->restRouteCollection->add($attribute->namespace, $attribute->route, [
                    'methods' => $attribute->methods,
                    'callback' => [$serviceInstance, $method->name],
                    'permissionCallback' => [$serviceInstance, 'permissionCheck'],
                    'args' => $serviceInstance->getArgs(),
                ]);
            });
        }
    }

    /**
     * Callback that registers all routes collected in `RestRouteCollection`.
     *
     * @see RestRouteCollection
     */
    protected function registerRestRoutes(): void
    {
        foreach ($this->restRouteCollection as $namespace => $routes) {
            foreach ($routes as $route) {
                $path = $route['route'];
                unset($route['route']);

                register_rest_route($namespace, $path, $route);
            }
        }
    }

    /**
     * Callback that registers all routes from service classes extending `AbstractController`
     * and using the `Route` attribute.
     *
     * @see AbstractController
     */
    protected function registerRoutes(): void
    {
        if (!class_exists(RouteCollection::class)) {
            return;
        }

        foreach ($this->serviceInstances as $serviceInstance) {
            if (!$serviceInstance instanceof AbstractController) {
                continue;
            }

            $serviceReflection = new ReflectionClass($serviceInstance);
            $attributeResolver = new AttributeResolver(AnnotationRoute::class, $serviceReflection);
            $attributeResolver->fromMethod(function ($attribute, $method) use ($serviceInstance) {
                $this->routeCollection->add($attribute->getName(), new Route(
                    $attribute->getPath(),
                    array_merge($attribute->getDefaults(), [
                        'controller' => $serviceInstance,
                        'method' => $method->name
                    ]),
                    $attribute->getRequirements(),
                    $attribute->getOptions(),
                    $attribute->getHost(),
                    $attribute->getSchemes(),
                    $attribute->getMethods(),
                    $attribute->getCondition()
                ));
            });
        }

        $router = $this->injector->make(Router::class);
        $router->matchRequest();
    }

    /**
     * Registers all commands in service classes that implement `CommandInterface`.
     *
     * @see CommandInterface
     */
    protected function registerCliCommands(): void
    {
        if (!defined('WP_CLI') || !WP_CLI) {
            return;
        }

        foreach ($this->serviceInstances as $serviceInstance) {
            if (!$serviceInstance instanceof CommandInterface) {
                continue;
            }

            $serviceReflection = new ReflectionClass($serviceInstance);
            $attributeResolver = new AttributeResolver(Command::class, $serviceReflection);
            $attributeResolver->fromMethod(static function ($attribute, $method) use ($serviceInstance) {
                WP_CLI::add_command($attribute->name, [$serviceInstance, $method->name]);
            });
        }
    }
}