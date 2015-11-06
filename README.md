NewMarket Content Management
=====

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

This project makes an honest effort to support localization and assistive
technologies. Feel free to point out areas for improvement.

Status of the project
-----

Security features are not yet implemented. Currently, anyone who can log in to
the site will be able to create, edit and delete articles in any category.

There seem to be some issues with the Markdown editing.

Requirements
-----

 * PHP 5.5.9 (required by Laravel 5.1)
 * [Laravel 5.1+](http://laravel.com)
 * [jQuery](http://jquery.com) JavaScript library
 * [Bootstrap](http://getbootstrap.com) for layout
 * [Pen](http://sofish.github.io/pen) for editing article content
 * [CommonMark](http://commonmark.thephpleague.com) for translation of markdown content to HTML
 * [Composer](http://getcomposer.org) for all package management and autoloading

Optional
-----

 * [Slugify](https://github.com/curco/slugify) may produce better results for non-English languages

Installing Composer
-----
See the [basic usage guide](http://getcomposer.org/doc/01-basic-usage.md) or follow the steps below. This command
will download `composer.phar` to the current directory.

    curl -s http://getcomposer.org/installer | php

Installation for existing projects
-----

For an existing project, add `newmarkets/content` to the `require` section of your `composer.json` file.

    "require": {
        "newmarkets/content": "*"
    }

Install dependencies with Composer. This will download and install NewMarket Content Management and
other packages it requires (and possibly other packages that they require, etc).

    php composer.phar install

You can also do this in one step using Composer's require command.

    php composer.phar require newmarkets/content

Installation for new projects
-----

If this is a new project, first run the following command. Composer will install Laravel, then invoke Laravel to
build a skeleton application in a new directory named `newproject` (or whatever name you provide).

    php composer.phar create-project laravel/laravel newproject

Edit the `composer.json` file and add an entry for `minimum-stability`. You may change this setting later.
This is temporarily necessary because `newmarkets/content` is not yet in a released state.

    "minimum-stability": "dev"

Now run the following from the command line. This will install the content system and add `newmarkets/content`
to the `composer.json` file.

    cd newproject
    php composer.phar require newmarkets/content

New projects need to configure the web server and set up a database at this point. The document root for a Laravel
site is the `/public` directory. Database connection information should go into the `.env` file at the root of the
project. Remember to set permissions on the `/storage` directory so the web server user can write files there. Pull
up the home page of the new site before continuing to make sure everything is working.

Completing the installation
-----

Add the service provider to your Laravel configuration in `newproject/config/app.php`. There will be a big array
of providers. Insert this one anywhere in the list (recommedation: put it at the bottom).

    return [
        'providers' => [
            NewMarket\Content\Providers\ContentServiceProvider::class
        ]
    ];

Run the `content:install` command via Artisan to set up database tables and
copy views, config files, javascript files and CSS into your application directories.
(For an alternative installation method, see Customization below.)

    php artisan content:install

The content management system will run at this point. You can find it under http://yourdomain.com/cms
(the "cms" part can be changed--see the next section). You will need to log in to add your first category. New
projects need to set up authentication routes, views and database tables. Laravel makes this fairly painless; review
the [Authentication Quickstart](http://laravel.com/docs/5.1/authentication#authentication-quickstart).

In addition to the steps in the Authentication Quickstart, there are two important additional steps. Set the `url`
correctly in `config/app.php`. And run a migration to set up the authentication tables.

    php artisan migrate


Configuration
-----

There are many settings in the configuration file to help you make this system conform to your design.
Review those settings in `config/content.php`. If you don't see that file in your application, see the next
section for the Artisan command that will copy it there.

The most important settings are `extends` and `yields`.
These two control how your content renders into your existing site templates. If you are new to Laravel,
review the [Blade documentation](http://laravel.com/docs/5.1/blade).

Customization
-----

You will probably want to customize the templates and CSS. You may want to change some configuration options.
If you modify the files in the `vendor/newmarkets/content` directory, Composer may wipe out your changes the next
time you `install` or `update` packages. You need a safe copy to make your changes. To get copies of all files that
you can work with, run the Artisan vendor:publish command.

    php artisan vendor:publish

This will publish any vendor content into your application directories. You can make changes to these files and
Composer will leave them alone.

You may want to be a little more discriminating. To publish only this package, add the `--provider` tag.

    php artisan vendor:publish --provider="NewMarket\Content\Providers\ContentServiceProvider"

If you only want the views, the config file or the public files, add the `--tag` option to the Artisan command.

 * config: just the configuration file
 * views: just the view templates
 * assets: javascript and CSS (this is already done as part of the content:install command)

Like so:

    php artisan vendor:publish --tag="config"

You can combine the `--tag` option with the `--provider` option. You can delete any
configuration options from the `config/content.php` file that you are not changing.

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

License
-----

Licensed under the MIT license.
