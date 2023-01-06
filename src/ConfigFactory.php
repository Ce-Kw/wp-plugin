<?php

declare(strict_types=1);

namespace CEKW\WpPlugin;

/**
 * Factory which constructs the `CEKW\WpPlugin\Config` object.
 */
class ConfigFactory
{
    public static function create(string $pluginFile): Config
    {
        return new Config(
            basename: plugin_basename($pluginFile),
            dirPath: plugin_dir_path($pluginFile),
            dirUrl: plugin_dir_url($pluginFile)
        );
    }
}