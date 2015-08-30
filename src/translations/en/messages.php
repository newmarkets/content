<?php
return [
    'article' => 'Article|Articles',
    'category' => 'Category|Categories',

    // These entries are mostly used as labels on data entry forms
    // or as column labels for lists of articles or categories
    'created' => 'Created',
    'updated' => 'Updated',
    'deleted' => 'Deleted',
    'live_at' => 'Live date', // initial publication date
    'down_at' => 'Removal date', // final publication date
    'slug' => 'Slug', // search engine friendly part of the URL to an article
    'title' => 'Title',
    'subtitle' => 'Subtitle',
    'author' => 'Author',
    'sourcename' => 'Source name',
    'sourceurl' => 'Source URL',
    'description' => 'Description',
    'content' => 'Content', // article text
    'meta_title' => 'Meta title', // title for the HTML meta tag
    'meta_keywords' => 'Meta keywords', // content for the HTML meta keywords tag
    'meta_description' => 'Meta description', // content for the HTML meta description tag
    'active' => 'Active', // is this article visible?
    'featured' => 'Featured', // does this article show up on the Featured list?
    'filename' => 'Filename', // name for a downloadable file
    'filename_description' => 'File description',
    'sortorder' => 'Sort order',
    'path' => 'Path', // root portion of the URL associated with a category

    // These are used for buttons or actions
    'edit' => 'Edit',
    'save' => 'Save',
    'delete' => 'Delete',
    'add' => 'Add',

    // These are prompts
    'add_article' => 'New article',
    'add_category' => 'New category',
    'delete_confirm' => 'Delete this article?',
    'delete_category' => 'Delete this category?',
    'click_to_edit' => 'Click to edit',

    // other stuff
    'unknown' => 'unknown', // fills in for null content like missing author name
];
