<?php
$lang = isset($_GET['lang']) ? $_GET['lang'] : "";

if (!empty($lang)) {
    $curr_lang = $_SESSION['curr_lang'] = $lang;
} else if (isset($_SESSION['curr_lang'])) {
    $curr_lang = $_SESSION['curr_lang'];
} else {
    $curr_lang = DEFAULT_LANGUAGE;
}

if (file_exists("language/" . $curr_lang . ".php")) {
    include "language/" . $curr_lang . ".php";
} else {
    include "language/en.php";
}
?>
