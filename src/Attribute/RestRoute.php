<?php

namespace CEKW\WpPlugin\Attribute;

use Attribute;

/**
 * Attribute class as a wrapper around `register_rest_route`.
 */
#[Attribute(Attribute::TARGET_METHOD)]
class RestRoute
{
    public function __construct(
        /**
         * The base URL for route you are adding.
         */
        public readonly string $route,
        /**
         * The first URL segment after core prefix. Should be unique to your package/plugin.
         */
        public readonly string $namespace,
        /**
         * The HTTP methods this route supports.
         */
        public readonly array $methods = ['GET']
        // phpcs:ignore Squiz.WhiteSpace.ScopeClosingBrace
    ) {}
}