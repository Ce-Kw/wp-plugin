<?php

namespace CEKW\WpPlugin\Tests;

use CEKW\WpPlugin\Loader;

use function Brain\Monkey\Functions\expect;
use function Brain\Monkey\Functions\when;

class LoaderTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $GLOBALS['wpdb'] = '';

        when('plugin_basename')->justReturn('');
        when('plugin_dir_path')->justReturn('');
        when('plugin_dir_url')->justReturn('');
    }

    public function testBootstrapHasHooks()
    {
        expect('register_activation_hook')->once();
        expect('register_deactivation_hook')->once();

        $loader = new Loader('');
        $loader
            ->addServices([])
            ->bootstrap();

        $this->assertNotFalse(has_action('plugins_loaded'));
        $this->assertNotFalse(has_action('rest_api_init'));
        $this->assertNotFalse(has_action('init'));
    }
}