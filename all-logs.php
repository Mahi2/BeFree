<?php
require("core.php");
head();

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $table = $prefix . 'logs';
    $query = $mysqli->query("DELETE FROM `$table` WHERE id='$id'");
}

if (isset($_GET['delete-all'])) {
    $table = $prefix . 'logs';
    $query = $mysqli->query("TRUNCATE TABLE `$table`");
}
?>
