<?php

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $file = __DIR__.$_SERVER['REQUEST_URI'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__.'/../vendor/autoload.php';
session_start();

$settings = require __DIR__.'/../src/configuration/settings.php';
$app = new \Slim\App($settings);

require __DIR__.'/../src/configuration/dependencies.php';
require __DIR__.'/../src/routes.php';

$app->run();
