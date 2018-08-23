<?php
include "core.php";
head();

$database_host     = $_SESSION['database_host'];
$database_username = $_SESSION['database_username'];
$database_password = $_SESSION['database_password'];
$database_name     = $_SESSION['database_name'];
$table_prefix      = $_SESSION['table_prefix'];
$username          = $_SESSION['username'];
$password          = hash('sha256', $_SESSION['password']);

if (isset($_SERVER['HTTPS'])) {
    $htp = 'https';
} else {
    $htp = 'http';
}
$site_url             = $htp . '://' . $_SERVER['SERVER_NAME'];
$fullpath             = "$htp://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$projectsecurity_path = substr($fullpath, 0, strpos($fullpath, '/install'));
