<?php
  require('core.php');
  head();

  if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $table = $prefix . 'bans-country';
    $query = $mysqli->query("DELETE FROM `$table` WHERE id='$id'");
}

if (isset($_GET['blacklist'])) {
    $table = $prefix . 'settings';
    $query = $mysqli->query("UPDATE `$table` SET countryban_blacklist='1' WHERE id=1");
}

if (isset($_GET['whitelist'])) {
    $table = $prefix . 'settings';
    $query = $mysqli->query("UPDATE `$table` SET countryban_blacklist='0' WHERE id=1");
}
?>

?>
