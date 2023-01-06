<?php

declare(strict_types=1);

namespace CEKW\WpPlugin\Tests;

class WP_CLI_Mock
{
    public static array $lines;
    public static array $errors;

    public static function line(string $string): void
    {
        self::$lines[] = $string;
    }

    public static function error(string $string): void
    {
        self::$errors[] = $string;
    }

    public static function colorize(string $string): string
    {
        return $string;
    }
}