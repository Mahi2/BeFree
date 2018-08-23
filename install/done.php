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

@$db = new mysqli($database_host, $database_username, $database_password, $database_name);
if ($db) {

    //Importing SQL Tables
    $query = '';

    $sql_dump = file('sql/database.sql');

    $sql_dump = str_replace("<DB_PREFIX>", $table_prefix, $sql_dump);
    $sql_dump = str_replace("<PROJECTSECURITY_PATH>", $projectsecurity_path, $sql_dump);

    foreach ($sql_dump as $line) {

        $startWith = substr(trim($line), 0, 2);
        $endWith   = substr(trim($line), -1, 1);

        if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
            continue;
        }

        $query = $query . $line;
        if ($endWith == ';') {
            mysqli_query($db, $query) or die('Problem in executing the SQL query <b>' . $query . '</b>');
            $query = '';
        }
    }
    
