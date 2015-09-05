<?php
/*
 * Note for translators:
 * Translate only the right-hand side of the array (after the => ).
 * You do not need to translate the comments (things after // ). These are only to help you understand
 * how that bit of text will be used in the application.
 * Thanks for helping!
 */
return [
    'article' => 'Article|Articles',
    'category' => 'Category|Categories',

    // These entries are mostly used as labels on data entry forms
    // or as column labels for lists of articles or categories
    'created' => 'Created',
    'updated' => 'Updated',
    'deleted' => 'Deleted',
    'slug' => 'Slug', // search engine friendly part of the URL to an article
    'title' => 'Title',
    'subtitle' => 'Subtitle',
    'author' => 'Author',
    'description' => 'Description',
    'content' => 'Content', // article text
    'sourcename' => 'Source name',
    'sourceurl' => 'Source URL',
    'meta_title' => 'Meta title', // title for the HTML meta tag
    'meta_keywords' => 'Meta keywords', // content for the HTML meta keywords tag
    'meta_description' => 'Meta description', // content for the HTML meta description tag
    'live_at' => 'Live date', // initial publication date
    'down_at' => 'Removal date', // final publication date
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
    'cancel' => 'Cancel',

    // These are the tabs on the editor screen
    'editing_tab' => 'Editing',
    'content_tab' => 'Content',
    'publishing_tab' => 'Publishing',
    'searching_tab' => 'Searching',
    'source_tab' => 'Original source',
    'downloading_tab' => 'Download',

    // These are the headings on each tab of the editor screen
    'article_information' => 'Article information', // describes the title, subtitle, author fields
    // there is no heading on the content tab
    'source_information' => 'Source citation', // describes the purpose of the "source" fields
    'search_information' => 'Search engine information', // describes the purpose of the "meta" fields
    'publication_information' => 'Publication controls', // describes live_at, down_at, active and featured
    'download_information' => 'Download information', // describes the "filename" fields

    // These are prompts
    'add_article' => 'New article',
    'add_category' => 'New category',
    'edit_article' => 'Edit this article',
    'edit_category' => 'Edit this category',
    'list_articles' => 'List articles',
    'list_categories' => 'List categories',
    'delete_article' => 'Delete this article',
    'delete_confirm' => 'Delete this article?',
    'delete_category' => 'Delete this category',
    'delete_category_confirm' => 'Delete this category?',
    'click_to_edit' => 'Click to edit',
    'editor_stay_msg' => 'If you leave the page without saving, your changes will be lost. Leave now?',
    'editor_placeholder' => 'Begin editing right here. Just type!\n\nSelect some text to see the toolbar.',
    'change_warning' => 'Changing this information will break any links to this page.',

    // other stuff
    'unknown' => 'unknown', // fills in for null content like missing author name
    'content_saved' => 'Article saved. See it <\a href="view:">here<\/a>.', // displayed after an article has been saved in the editor. do not change "view:"
    'tagged_with' => 'This article has been tagged for the following subjects',

];
