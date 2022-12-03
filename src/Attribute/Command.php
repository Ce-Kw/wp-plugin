<?php

namespace CEKW\WpPlugin\Attribute;

use Attribute;

/**
 * Attribute class as a wrapper around `WP_CLI::add_command()`.
 */
#[Attribute(Attribute::TARGET_METHOD)]
class Command
{
    public function __construct(
        /**
         * Name for the command.
         */
        public readonly string $name
        // phpcs:ignore Squiz.WhiteSpace.ScopeClosingBrace
    ) {}
}