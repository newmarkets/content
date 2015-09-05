NewMarket Content Management
======

_This project is a work-in-progress. Check back in a week or contact me
if you want to help._

This package is a Content Management System for Laravel 5.1. It could
be used for a simple blog. Articles within the system are divided into
categories--as many as you like. Security is based on the categories;
users may have access to read, create, edit, delete, publish and unpublish
within each category separately from other categories.

On your site, each category resides under a unique path. You could have a
category named "Geoffrey's Wild Tales" with a path of "pilgrimages." The URL
to this category would look like http://domain.com/pilgrimages and articles
would look like http://domain.com/pilgrimages/a-worthy-man.

Content in the system uses Markdown syntax for formatting. We are using
[Pen](https://github.com/sofish/pen) as an editor with its optional markdown
export option.

This project makes an honest effort to support localization and assitive
technologies. Feel free to point out areas for improvement.

Requirements
------------

 * PHP 5.5.9 (required by Laravel 5.1)
 * [Laravel 5.1+](http://laravel.com)
 * [jQuery](http://jquery.com) JavaScript library
 * [Bootstrap](http://getbootstrap.com) for layout
 * [Pen](https://github.com/sofish/pen) for editing article content
 * [CommonMark](https://github.com/league/commonmark) for translation of markdown content to HTML
 * [Composer](http://getcomposer.org) for all package management and autoloading

Optional
------------

 * [Slugify](https://github.com/curco/slugify) may produce better results for non-English languages

Installing Composer
-----
See the [basic usage guide](http://getcomposer.org/doc/01-basic-usage.md) or follow the steps below. This command
will download `composer.phar` to the current directory.

    curl -s http://getcomposer.org/installer | php

Install for existing projects
-----

For an existing project, add `newmarkets/content` to the `require` section of your `composer.json` file.

    "require": {
        "newmarkets/content": "*"
    }

Install dependencies with Composer. This will download and install NewMarket Content Management and
other packages it requires (and possibly other packages that they require, etc).

    php composer.phar install

Alternate install for new projects
-----

If this is a new project, first run the following command. Composer will install Laravel, then invoke Laravel to
build a skeleton application in a new directory named `newproject` (or whatever name you provide).

    php composer.phar create-project laravel/laravel newproject

Edit the `composer.json` file and add an entry for `minimum-stability`. You may change this setting later.
This is temporarily necessary because `newmarkets/content` is not yet in a released state.

    "minimum-stability": "dev"

Now run the following from the command line. This will install the content system and add `newmarkets/content`
to the `composer.json` file.

    php composer.phar require newmarkets/content

Completing the installation
-----

Add the service provider to your Laravel configuration in `config/app.php`. There will be a big array of providers.
Insert this one anywhere in the list (recommedation: put it at the bottom).

    return [
        'providers' => [
            NewMarket\Content\Providers\ContentServiceProvider::class
        ]
    ];

Run the `content:install` command via Artisan to set up database tables and
copy views, config files, javascript files and CSS into your application directories.
(For an alternative installation method, see below.)

    php artisan content:install

The content management system will run at this point. You can find it under
http://yourdomain.com/content.

Customizing
-------------

You will probably want to customize the templates and CSS. You may want to
change some configuration options. To get a copy of all files that you can
work with, run the Artisan vendor:publish command.

    php artisan vendor:publish

This will publish any vendor content into your application directories. You may
want to be a little more discriminating. To publish only this package, add
the --provider tag.

    php artisan vendor:publish --provider="NewMarket\Content\Providers\ContentServiceProvider"

If you only want the views, the config file or the public files, add the --tag
option to the Artisan command.

 * config: just the configuration file
 * views: just the view templates
 * assets: javascript and CSS (we did this already above)

Like so:

    php artisan vendor:publish --tag="config"

You can combine the --tag option with the --provider option. You can delete any
configuration options from the config/content.php file that you are not changing.

Contributing
-------------

Contributions are invited. All contributions--new features or bug fixes--must include tests.
To run the test suite, simply run `phpunit` in the root of the
directory (even if that is /vendor/newmarkets/content). Please make sure to add tests
and run the test suite before submitting pull requests for any contributions.

Translators
-----------

Translators are very welcome. To build a new language translation, copy the `translations/en/messages.php`
file into a new directory using the standard ISO abbreviation for the language.
For instance, the translation file for French would go in `translations/fr/messages.php`.
Leave all of the keys in the array unchanged. Translate the right-hand side
(the array values) into the target language. Don't translate any word that begins
with a colon (:). The vertical bar separates singular and plural forms of the word.
