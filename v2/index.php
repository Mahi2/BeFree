<?php

use Befree\Befree;

/**
 * loads configuration and autoloader
 */
require_once(__DIR__ . "/config/constants.php");
require_once(__DIR__ . "/vendor/autoload.php");


$container = new \DI\ContainerBuilder();
$container->addDefinitions(ROOT . "/config/container.php");
$container = $container->build();


/**
 * Setting up a new Befree application
 */
$app = new Befree($container);
$app->setDatabaseConfigFile(__DIR__ . "/config.php");
$app->isInstalled();
$app->run();