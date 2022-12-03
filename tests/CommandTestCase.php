<?php

namespace CEKW\WpPlugin\Tests;

use WP_CLI;

class CommandTestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (!class_exists(WP_CLI::class)) {
            class_alias(WP_CLI_Mock::class, WP_CLI::class);
        }

        WP_CLI_Mock::$lines = [];
        WP_CLI_Mock::$errors = [];
    }
}