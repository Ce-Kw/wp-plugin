<?php

declare(strict_types=1);

namespace CEKW\WpPlugin;

use CEKW\WpPlugin\CommandInterface;
use CEKW\WpPlugin\Attribute\Command;
use WP_CLI;

use function WP_CLI\Utils\format_items;

class DebugRestRouterCommand implements CommandInterface
{
    public function __construct(
        protected RestRouteCollection $restRouteCollection
        // phpcs:ignore Squiz.WhiteSpace.ScopeClosingBrace
    ) {}

    /**
     * Display current REST routes added from this plugin.
     *
     * ## EXAMPLES
     *
     *     wp cekw debug:rest-router
     *
     * @when before_wp_load
     */
    #[Command(name: 'cekw debug:rest-router')]
    public function __invoke(array $args, array $assocArgs)
    {
        $items = [];
        foreach ($this->restRouteCollection as $namespace => $routes) {
            foreach ($routes as $route) {
                $items[] = [
                    'Namespace' => $namespace,
                    'Method' => $route['methods'],
                    'Path' => $route['route'],
                    'Controller' => implode(
                        '::',
                        array_map(
                            fn($param) => $param instanceof AbstractRestController ? get_class($param) : $param,
                            $route['callback']
                        )
                    )
                ];
            }
        }

        if (empty($items)) {
            WP_CLI::error('No REST routes found.');
        }

        format_items('table', $items, array_keys($items[0]));
    }
}