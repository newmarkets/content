<?php
namespace Content\Tests;

/**
 * Testing to see if translation files are found by Laravel. We don't need to test every value.
 *
 */

use Article;
use Category;
use Cms;

class FacadeTest extends TestCase {

    public function testArticleResolution() {

        $this->assertEquals('NewMarket\\Content\\Models\\Article', get_class($this->app->make('article')));

    }

    public function testCategoryResolution() {

        $this->assertEquals('NewMarket\\Content\\Models\\Category', get_class($this->app->make('category')));

    }

    public function testCmsResolution() {

        $this->assertEquals('NewMarket\\Content\\Models\\Cms', get_class($this->app->make('cms')));

    }
}
