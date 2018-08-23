<?php
@session_start();

include_once "settings.inc.php";

// Returns language key
function lang_key($key)
{
    global $arrLang;
    $output = "";

    if (isset($arrLang[$key])) {
        $output = $arrLang[$key];
    } else {
        $output = str_replace("_", " ", $key);
    }
    return $output;
}

include_once "languages.inc.php";

if (file_exists(CONFIG_FILE_PATH)) {
    echo '<meta http-equiv="refresh" content="0; url=../" />';
    exit;
}

function head()
{
?>
