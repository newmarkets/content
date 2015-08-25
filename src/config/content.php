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
    'category_prefix' => 'category_'

];
