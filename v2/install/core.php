<?php

define("DEFAULT_LANGUAGE", "en");
define("CONFIG_FILE_DIRECTORY", dirname(__DIR__) . "/");
define("CONFIG_FILE_NAME", "config.php");
define("CONFIG_FILE_PATH", CONFIG_FILE_DIRECTORY . CONFIG_FILE_NAME);
define("CONFIG_FILE_TEMPLATE", "config.tpl");


if (file_exists(CONFIG_FILE_NAME)) {
    header("Location: ../index.php", true, 403);
    exit();
} else {
    if (session_status() === PHP_SESSION_NONE) {
        session_name('befree-session');
        session_start();
    }

    $activeLang = [
        "en" => "English",
        "bg" => "Български",
        "es" => "Spanish",
        "de" => "German"
    ];

    $lang = $_GET['lang'] ?? "";
    $currLang = $lang ?? $_SESSION ?? DEFAULT_LANGUAGE;
    include(file_exists("language/{$currLang}.php") ? "language/{$currLang}.php"  : "language/en.php");


    function _lang(string $key): string
    {
        global $arrLang;
        return $arrLang[$key] ?? str_replace("_", " ", $key);
    }
}
