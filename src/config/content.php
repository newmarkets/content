<?php

return [
    // This is the name of the template in which the CMS content should appear. If you are using Blade,
    // this corresponds to the @extends tag at the top of a template. A simple setting of
    //    'extends' => 'master'
    // effectively puts an @extends('master') at the top of the CMS templates and thereby wraps CMS
    // content in your master.blade.php template.
    'extends' => 'app',

    // This is the name of the section for the CMS content. Using the default value ("content"), the CMS
    // content will appear in your template wherever you place the @yields('content') directive.
    'yields' => 'content',

    // The CMS also needs to add a stylesheet and javascript to your template. These two settings control
    // where those are placed. Your template should have a @yields('style') in the head (before your
    // own stylesheet so you can override CMS settings). Your template should have a @yields('script')
    // directive so the CMS can place a javascript. This script is only needed for the entry forms.
    'style' => 'style',
    'script' => 'script',

    // These settings control other section names which you can add to your master template in appropriate
    // places. These are not required.
    'title' => 'title',
    'meta_title' => 'meta_title',
    'meta_keywords' => 'meta_keywords',
    'meta_description' => 'meta_description',

    // This flag tells CMS to show a preview of the most recent articles in all categories when the
    // URL looks like http:://yourdomain.com/content. The alternative is to list the categories available.
    'show_latest' => false,

    // This flag tells CMS to show a preview of the most recent articles in one category--a magazine--when the
    // URL looks like http://yourdomain.com/content/index. The alternative is to list the articles.
    'show_category_latest' => true,

    // URLs to articles are formed by lowercasing the title and joining the words with some character.
    // The usual choices are hyphen and underscore. Underscores have the disadvantage of disappearing
    // when the URL is underlined, which frequently happens in an emails or documents. Therefore our default
    // setting is the hyphen.
    'slug_separator' => '-',

    // The layout of the package templates uses Bootstrap. Bootstrap's Grid offers a choice of screen widths
    // which is selected by the class prefix of the grid column. @see http://getbootstrap.com/css/#grid-options
    // The default for this CMS is "lg" which results in a container width of 1170px (wide desktop screens).
    // You can change this to match the layout of your site. If you are not using Bootstrap, this setting
    // probably won't have any effect.
    'col' => 'col-lg',

];
