<?php

use Befree\Befree;

/**
 * loads configuration and autoloader
 */
require_once (__DIR__ . "/config/constants.php");
require_once(__DIR__ . "/vendor/autoload.php");


/**
 * Setting up a new Befree application
 */
$befree = new Befree();
$befree->setDatabaseConfigFile(__DIR__. "/config/database.php");
$befree->isInstalled();
$befree->run();


include "config.php";

session_start();

if (isset($_SESSION['sec-username'])) {
    $uname = $_SESSION['sec-username'];
    $table = $prefix . 'users';
    $suser = $mysqli->query("SELECT * FROM `$table` WHERE username='$uname'");
    $count = mysqli_num_rows($suser);
    if ($count > 0) {
        echo '<meta http-equiv="refresh" content="0; url=dashboard.php" />';
        exit;
    }
}

$_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$error = 0;
