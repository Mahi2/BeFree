<?php
$connexion = new \Befree\Database\MysqlDatabase("<DB_NAME>", "<DB_HOST>", "<DB_USER>", "<DB_PASSWORD>");

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