<?php
$host     = "<DB_HOST>"; // Database Host
$user     = "<DB_USER>"; // Database Username
$password = "<DB_PASSWORD>"; // Database's user Password
$database = "<DB_NAME>"; // Database Name
$prefix   = "<DB_PREFIX>"; // Database Prefix for the script tables

$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
$mysqli->set_charset("utf8");

return [
"database.host" => "<DB_HOST>",
"database.user" => "<DB_USER>",
"database.password" => "<DB_PASSWORD>",
"database.name" => "<DB_NAME>",
"database.prefix" => "<DB_PREFIX>",

"site_url" => "<SITE_URL>",
"befree_path" => "<PROJECTSECURITY_PATH>"
];