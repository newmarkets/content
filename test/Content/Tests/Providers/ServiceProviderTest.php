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
        // ensure we have a known config value
        Config::set('content.category_base', 'baz');

        // this will rebuild the routes
        $provider = new ContentServiceProvider($this->app);
        $provider->boot();

        /**
         * @var \Illuminate\Routing\RouteCollection
         */
        $routeCol = $this->app['router']->getRoutes();

        // resource routes are named
        $this->assertNotNull($routeCol->getByName('foobar.article.index'));
        $this->assertNotNull($routeCol->getByName('foobar.article.create'));
        $this->assertNotNull($routeCol->getByName('foobar.article.store'));
        $this->assertNotNull($routeCol->getByName('foobar.article.edit'));
        $this->assertNotNull($routeCol->getByName('foobar.article.update'));
        $this->assertNotNull($routeCol->getByName('foobar.article.destroy'));

        // check some routes that are not named
        // could improve this by checking method, too
        $all_routes = $routeCol->getRoutes();
        $uris = array_map(function ($route) {
            return $route->getUri();
        }, $all_routes);
        $this->assertTrue(in_array('foobar/article/slug', $uris));
        $this->assertTrue(in_array('foobar/{article}', $uris));
        $this->assertTrue(in_array('foobar', $uris));

        // cms category management routes
        $this->assertTrue(in_array('baz', $uris));
        $this->assertTrue(in_array('baz/create', $uris));
        $this->assertTrue(in_array('baz/{baz}', $uris));
        $this->assertTrue(in_array('baz/{baz}/edit', $uris));

    }
}
