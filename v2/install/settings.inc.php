<?php
define("DEFAULT_LANGUAGE", "en");

// Array of available languages
$arr_active_languages = array(
    "en" => "English",
    "bg" => "Български",
    "es" => "Spanish",
    "de" => "German"
);

// Config file directory - Directory, where config file must be
define("CONFIG_FILE_DIRECTORY", "../");

// Config file name - Output file with config parameters (database, username etc.)
define("CONFIG_FILE_NAME", "config.php");

// According to directory hierarchy (you may add/remove "../" before CONFIG_FILE_DIRECTORY)
define("CONFIG_FILE_PATH", CONFIG_FILE_DIRECTORY . CONFIG_FILE_NAME);

// Config file name - config template file name
define("CONFIG_FILE_TEMPLATE", "config.tpl");
?>
