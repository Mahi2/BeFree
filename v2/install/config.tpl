<?php
$mysqli = new mysqli("<DB_HOST>", "<DB_USER>", "<DB_PASSWORD>", "<DB_NAME>");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
$mysqli->set_charset("utf8");

return [
   "database" => [
        "host" => "<DB_HOST>",
        "user" => "<DB_USER>",
        "password" => "<DB_PASSWORD>",
        "name" => "<DB_NAME>",
        "prefix" => "<DB_PREFIX>",
    ],

    "site_url" => "<SITE_URL>",
    "befree_path" => "<PROJECTSECURITY_PATH>"
];