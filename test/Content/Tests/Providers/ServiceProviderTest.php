<?php
namespace Content\Tests;

/**
 * Verify that our content:install command is properly registered.
 *
 */

use Illuminate\Support\ServiceProvider;
use Category;
use Config;
use NewMarket\Content\Providers\ContentServiceProvider;

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

    public function testRouteToContent() {

        Category::shouldReceive('getPublicCategories')
            ->once()
            ->andReturn([
                // set up a known content path
                (object) ['path' => 'foobar']
            ]);

        // this will rebuild the routes
        $provider = new ContentServiceProvider($this->app);
        $provider->boot();

        $this->assertHasNamedRoute('foobar.article.index');
        $this->assertHasNamedRoute('foobar.article.create');
        $this->assertHasNamedRoute('foobar.article.store');
        $this->assertHasNamedRoute('foobar.article.edit');
        $this->assertHasNamedRoute('foobar.article.update');
        $this->assertHasNamedRoute('foobar.article.destroy');
        $this->assertHasResourceRoute('foobar/article', ['show'], 'article');

        $this->assertHasRoute('GET', 'foobar/article/slug');
        $this->assertHasRoute('GET', 'foobar/{article}');
        $this->assertHasRoute('GET', 'foobar');

    }

    public function testRouteToCms() {

        // ensure we have a known config value
        Config::set('content.category_base', 'baz');

        // this will rebuild the routes
        $provider = new ContentServiceProvider($this->app);
        $provider->boot();

        // cms category management routes
        $this->assertHasResourceRoute('baz', [], 'baz');

    }
}
