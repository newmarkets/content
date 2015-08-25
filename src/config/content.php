<?php

return [
    // This is the name of the template in which the CMS content should appear. If you are using Blade,
    // this corresponds to the @extends tag at the top of a template. A simple setting of
    //    'extends' => 'master'
    // effectively puts an @extends('master') at the top of the CMS templates and thereby adds CMS
    // content to your master.blade.php template.
    // This setting can also be an array of template names. The default setting causes CMS content
    // to be available in the news, blog and story templates.
    'extends' => ['news', 'blog', 'story'],

    // This is a prefix for the names under which the CMS article properties will be available.
    // For instance, using the default prefix the article title will be available as article_title.
    // Add a @yields tag to your template where you want the content to appear. That tag would look like
    //    @yields('article_title')
    'article_prefix' => 'article_',

    // This is a prefix for the category properties.
    'category_prefix' => 'category_',

    // The "path" setting defines the URL root for the CMS. The default setting is "content" so the
    // URLs would look like http://yourdomain.com/content/...
    //
    // This setting can be an array, in which case the CMS can be found under multiple root paths.
    //     'path' => ['blog', 'news', 'market']
    //
    // This setting can be an empty string, in which case the CMS will pretty much take over the site.
    // Developers need to ensure that CMS routes are added last so that any other specific routes
    // are captured before the CMS is called.
    'path' => 'content',

    // This flag tells CMS to show a preview of the most recent articles in all categories when the
    // URL looks like http:://yourdomain.com/content. The alternative is to list the categories available.
    'show_latest' => true,

    // This flag tells CMS to show a preview of the most recent articles in one category when the
    // URL looks like http://yourdomain.com/content/category. The alternative is to list the articles.
    'show_category_latest' => true

];
