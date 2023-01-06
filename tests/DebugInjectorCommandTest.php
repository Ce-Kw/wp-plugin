<?php

declare(strict_types=1);

namespace CEKW\WpPlugin\Tests;

use Auryn\Injector;
use CEKW\WpPlugin\DebugInjectorCommand;

class DebugInjectorCommandTest extends CommandTestCase
{
    public function testSuccess()
    {
        $injector = new Injector();
        $injector->share(DebugInjectorCommandTest::class);

        $command = new DebugInjectorCommand($injector);
        $command([], ['type' => 'all']);

        $this->assertEquals([
            "Classes and interfaces that can be type-hinted.\n",
            '%y' . DebugInjectorCommandTest::class . '%n'
        ], WP_CLI_Mock::$lines);

        $this->assertEquals([], WP_CLI_Mock::$errors);
    }

    public function testError()
    {
        $injector = new Injector();

        $command = new DebugInjectorCommand($injector);
        $command([], ['type' => 'all']);

        $this->assertEquals([
            "Classes and interfaces that can be type-hinted.\n"
        ], WP_CLI_Mock::$lines);

        $this->assertEquals([
            'No classes or interfaces found.'
        ], WP_CLI_Mock::$errors);
    }
}