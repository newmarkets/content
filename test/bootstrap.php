<?php
/* This file was lifted from vlucas/bulletphp. Thanks Vance! */
error_reporting(-1);
date_default_timezone_set('UTC');
/**
 * Path trickery ensures test suite will always run, standalone or within
 * another composer package. Designed to find composer autoloader and require
 */
$dir = str_replace('\\', '/', __DIR__);
$vendorPos = strpos($dir, 'vendor/newmarkets/content');
if($vendorPos !== false) {
    // Package has been cloned within another composer package, resolve path to autoloader
    $vendorDir = substr(__DIR__, 0, $vendorPos) . 'vendor/';
    $loader = require $vendorDir . 'autoload.php';
} else {
    // Package itself (cloned standalone)
    $loader = require __DIR__.'/../vendor/autoload.php';
}
// Add path for tests
$loader->add('Content\Tests', __DIR__);
