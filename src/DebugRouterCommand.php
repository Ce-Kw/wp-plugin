<?php

declare(strict_types=1);

namespace CEKW\WpPlugin;

use CEKW\WpPlugin\CommandInterface;
use CEKW\WpPlugin\Attribute\Command;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use WP_CLI;

use function WP_CLI\Utils\format_items;

class DebugRouterCommand implements CommandInterface
{
    public function __construct(
        protected RouteCollection $routeCollection
        // phpcs:ignore Squiz.WhiteSpace.ScopeClosingBrace
    ) {}

    /**
     * Display additional routes added on top of WordPress.
     *
     * ## OPTIONS
     *
     * [<name>]
     * : The name of the route to get detailed information about.
     *
     * ## EXAMPLES
     *
     *     wp cekw debug:router
     *     wp cekw debug:router book_single
     *
     * @when before_wp_load
     */
    #[Command(name: 'cekw debug:router')]
    public function __invoke(array $args, array $assocArgs)
    {
        if (!empty($args[0])) {
            if (empty($this->routeCollection->get($args[0]))) {
                WP_CLI::error(sprintf('Route %s could not be found.', $args[0]));
            }

            $route = $this->routeCollection->get($args[0]);
            $items = [
                [
                    'Property' => 'Route Name',
                    'Value' => $args[0]
                ],
                [
                    'Property' => 'Path',
                    'Value' => $route->getPath()
                ],
                [
                    'Property' => 'Path Regex',
                    'Value' => $route->compile()->getRegex() ?? ''
                ],
                [
                    'Property' => 'Host',
                    'Value' => $route->getHost()
                ],
                [
                    'Property' => 'Host Regex',
                    'Value' => $route->compile()->getHostRegex() ?? ''
                ],
                [
                    'Property' => 'Scheme',
                    'Value' => $route->getSchemes()
                ],
                [
                    'Property' => 'Method',
                    'Value' => $route->getMethods()
                ],
                [
                    'Property' => 'Requirements',
                    'Value' => $route->getRequirements()
                ],
                [
                    'Property' => 'Class',
                    'Value' => get_class($route)
                ],
                [
                    'Property' => 'Defaults',
                    'Value' => array_merge(
                        $route->getDefaults(),
                        ['controller' => $this->getControllerFromRoute($route)]
                    )
                ],
                [
                    'Property' => 'Options',
                    'Value' => $route->getOptions()
                ]
            ];
        } else {
            $items = [];
            foreach ($this->routeCollection as $routeName => $route) {
                $items[] = [
                    'Name' => $routeName,
                    'Method' => $route->getMethods(),
                    'Scheme' => $route->getSchemes(),
                    'Host' => $route->getHost(),
                    'Path' => $route->getPath(),
                    'Controller' => $this->getControllerFromRoute($route)
                ];
            }

            if (empty($items)) {
                WP_CLI::error('No routes found.');
            }
        }

        format_items('table', $items, array_keys($items[0]));
    }

    protected function getControllerFromRoute(Route $route): string
    {
        $defaults = $route->getDefaults();

        return get_class($defaults['controller']) . '::' . $defaults['method'];
    }
}