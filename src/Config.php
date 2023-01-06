<?php

declare(strict_types=1);

namespace CEKW\WpPlugin;

/**
 * Readonly class which holds the plugin directory path, URL and basename.
 */
class Config
{
    public function __construct(
        /**
         * The basename of the plugin directory.
         */
        public readonly string $basename,
        /**
         * The directory path to the plugin root.
         */
        public readonly string $dirPath,
        /**
         * The URL to the plugin root.
         */
        public readonly string $dirUrl
        // phpcs:ignore Squiz.WhiteSpace.ScopeClosingBrace
    ) {}
}