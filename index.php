<?php
$configfile = 'config.php';
if (!file_exists($configfile)) {
    echo '<meta http-equiv="refresh" content="0; url=install" />';
    exit();
}

include "config.php";

session_start();

if (isset($_SESSION['sec-username'])) {
    $uname = $_SESSION['sec-username'];
    $table = $prefix . 'users';
    $suser = $mysqli->query("SELECT * FROM `$table` WHERE username='$uname'");
    $count = mysqli_num_rows($suser);
    if ($count > 0) {
        echo '<meta http-equiv="refresh" content="0; url=dashboard.php" />';
        exit;
    }
}

$_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$error = 0;
?>
