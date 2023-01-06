<?php

declare(strict_types=1);

namespace CEKW\WpPlugin;

/**
 * Should be implemented by all classes that are registering hooks for activation and deactivartion so that they can be auto-discovered.
 */
interface SetupHookSubscriberInterface
{
    public function activate(): void;

    public function deactivate(): void;

    public static function uninstall(): void;
}