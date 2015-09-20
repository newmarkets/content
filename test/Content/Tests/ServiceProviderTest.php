<?php
namespace Content\Tests;

/**
 * Verify that our content:install command is properly registered.
 *
 */

use Illuminate\Support\ServiceProvider;

class ServiceProviderTest extends TestCase {

    public function testViewFinder() {

        $factory = $this->app['view'];
        $this->assertTrue($factory->exists('newmarkets\content::article'));

    }

    public function testConfigMerge() {

        $factory = $this->app['config'];
        $this->assertTrue($factory->has('content'));

        $config = $factory->get('content', []);
        $this->assertGreaterThanOrEqual(10, count($config));

        $this->assertTrue(isset($config['category_base']));

    }

    public function testPublishedPathsViews() {

        $paths = ServiceProvider::pathsToPublish('NewMarket\Content\Providers\ContentServiceProvider', 'views');
        $this->assertTrue(count($paths) > 0);

    }

    public function testPublishedPathsConfig() {

        $paths = ServiceProvider::pathsToPublish('NewMarket\Content\Providers\ContentServiceProvider', 'config');
        $this->assertTrue(count($paths) > 0);

    }

    public function testPublishedPathsAssets() {

        $paths = ServiceProvider::pathsToPublish('NewMarket\Content\Providers\ContentServiceProvider', 'assets');
        $this->assertTrue(count($paths) > 0);

    }
}
