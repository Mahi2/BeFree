<?php
require("core.php");
head();

if (isset($_GET['delete-all'])) {
    $table = $prefix . 'bans';
    $query = $mysqli->query("TRUNCATE TABLE `$table`");
}

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $table = $prefix . 'bans';
    $query = $mysqli->query("DELETE FROM `$table` WHERE id='$id'");
}
?>
