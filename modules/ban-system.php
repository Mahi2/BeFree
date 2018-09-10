<?php
//Ban System
$table       = $prefix . 'bans';
$querybanned = $mysqli->query("SELECT ip FROM `$table` WHERE ip='$ip' LIMIT 1");
if ($querybanned->num_rows > 0) {
    $bannedpage_url = $projectsecurity_path . "/pages/banned.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $bannedpage_url . '" />';
    exit;
}
