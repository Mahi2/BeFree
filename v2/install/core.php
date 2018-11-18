<?php

/*
|--------------------------------------------------------------------------
| Installation configuration
|--------------------------------------------------------------------------
| Starts the session if none exists,
| Define $activeLang
| Define configuration constants
| Selection of the current language
*/

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

define("DEFAULT_LANGUAGE", "en");
define("CONFIG_FILE_DIRECTORY", dirname(__DIR__));
define("CONFIG_FILE_NAME", "config.php");
define("CONFIG_FILE_PATH", CONFIG_FILE_DIRECTORY . CONFIG_FILE_NAME);
define("CONFIG_FILE_TEMPLATE", "config.tpl");

$lang = $_GET['lang'] ?? "";
$currLang = $lang ?? $_SESSION ?? DEFAULT_LANGUAGE;
include(file_exists("language/{$currLang}.php") ? "language/{$currLang}.php"  : "language/en.php");


/**
 * @param string $key
 * @return mixed|string
 */
function _lang(string $key): string
{
    global $arrLang;
    return $arrLang[$key] ?? str_replace("_", " ", $key);
}

if (file_exists(CONFIG_FILE_NAME)) {
    header("Location: ../index.php", true, 403);
    exit();
}

function head()
{
?>
    <!DOCTYPE html>
<html lang="en">

<head>
    <title>BeFree - <?php
        echo lang_key("installation_wizard");
        ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/favicon.png">
    <meta charset="utf-8">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" media="screen">
    <link type="text/css" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
</head>

<body>

<div class="container">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-12">
                <br/>
                <center><h2><i class="fab fa-get-pocket"></i> BeFree - <?php
                        echo lang_key("installation_wizard");
                        ?></h2></center>
                <br/>
                <div class="jumbotron">
                    <?php
                    }

                    function footer()
                    {
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
<?php
}
?>
