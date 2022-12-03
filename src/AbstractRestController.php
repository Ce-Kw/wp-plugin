<?php

namespace CEKW\WpPlugin;

use WP_Error;

/**
 * Base class for custom REST routes.
 */
abstract class AbstractRestController
{
    /**
     * Checks if the user can perform the action (reading, updating, etc) before the real callback is called.
     */
    public function permissionCheck(): bool|WP_Error
    {
        return true;
    }

    /**
     * Defines arguments for the route.
     */
    public function getArgs(): array
    {
        return [];
    }
}