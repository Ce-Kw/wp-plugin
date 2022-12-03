<?php

namespace CEKW\WpPlugin\Attribute;

use Attribute;

/**
 * Attribute class as a wrapper around `add_filter`.
 */
#[Attribute(Attribute::TARGET_METHOD)]
class Filter
{
    public function __construct(
        /**
         * The name of the filter to add the callback to.
         */
        public readonly string $hookName,
        /**
         * Used to specify the order in which the functions associated with a particular filter are executed.
         * Lower numbers correspond with earlier execution, and functions with the same priority are executed in the order in which they were added to the filter.
         */
        public readonly int $priority = 10,
        /**
         * The number of arguments the function accepts.
         */
        public readonly int $acceptedArgs = 1
        // phpcs:ignore Squiz.WhiteSpace.ScopeClosingBrace
    ) {}
}