<?php
namespace Content\Tests;

/**
 * Verify that our content:install command is properly registered.
 *
 */

use Illuminate\Contracts\Console\Kernel;

class InstallTest extends TestCase {

    public function testInstallCommandPresent() {

        $commands = $this->app->make(Kernel::class)->all();

        $this->assertArrayHasKey('content:install', $commands);

        $install = $commands['content:install'];

        $this->assertTrue($install instanceof \NewMarket\Content\Commands\Install);

    }
}
