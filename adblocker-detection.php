<?php
require("core.php");
head();

if (isset($_POST['save'])) {
    $table = $prefix . 'adblocker-settings';

    if (isset($_POST['detection'])) {
        $detection = 1;
    } else {
        $detection = 0;
    }

    $redirect = $_POST['redirect'];

    $query = $mysqli->query("UPDATE `$table` SET detection='$detection', redirect='$redirect' WHERE id=1");
}
?>
