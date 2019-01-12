<?php

use Befree\Befree;

// Loads configuration and autoloader
require_once(__DIR__ . "/config/constants.php");
require_once(__DIR__ . "/vendor/autoload.php");


// Setting up a new Befree application
$app = new Befree(ROOT . "/config/container.php");
$app->errorHandler();

if ($app->isInstalled()) {
    if (php_sapi_name() !== 'cli') {
        $app->run();
    }
} else {
    $app->redirect('install/index.php', 403);
}
