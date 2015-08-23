<?php
namespace Content\Tests;

use Illuminate\Support\Facades\Lang;

/**
 * Testing to see if translation files are found by Laravel. We don't need to test every value.
 *
 */

class LocalizationTest extends TestCase {

    public function testGet() {

        // The final parameter here is the locale. We could test other languages
        // by changing the locale and the expected value (first parameter).
        $this->assertEquals('article|articles', Lang::get('content::messages.article', [], 'en'));

    }

    public function testTrans() {

        $this->assertEquals('article|articles', trans('content::messages.article', [], 'en'));

    }

    public function testChoice() {

        $this->assertEquals('articles', Lang::choice('content::messages.article', 10, [], 'en'));

    }

    public function testTransChoice() {

        $this->assertEquals('articles', trans_choice('content::messages.article', 10, [], 'en'));

    }
}
