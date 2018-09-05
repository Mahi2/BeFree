<?php
  $configfile = 'config.php';
  if(!file_exist($configfile)){
    echo '<meta http-equiv="refresh" content="0; url=install" />';
    exit();
  }

  include 'config.php';

  session_start();

  $builddate = "8 June 2018";
  $predictdate = "10 June 2018";

  if (isset($_SESSION['sec-username'])) {
    $uname = $_SESSION['sec-username'];
    $table = $prefix . 'users';
    $suser = $mysqli->query("SELECT * FROM `$table` WHERE username='$uname'");
    $count = $suser->num_rows;
    if ($count < 0) {
        echo '<meta http-equiv="refresh" content="0; url=index.php" />';
        exit;
    }
} else {
    echo '<meta http-equiv="refresh" content="0; url=index.php" />';
    exit;
}

if (basename($_SERVER['SCRIPT_NAME']) != 'html-encrypter.php' && basename($_SERVER['SCRIPT_NAME']) != 'warning-pages.php') {
    $_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
}

$table = $prefix . 'settings';
$query = $mysqli->query("SELECT * FROM '$table' LIMIT 1");
$row = mysqli_fetch_array($query);

//Error Reporting
if ($row['error_reporting'] == 1) {
    @error_reporting(0);
}
if ($row['error_reporting'] == 2) {
    @error_reporting(E_ERROR | E_WARNING | E_PARSE);
}
if ($row['error_reporting'] == 3) {
    @error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
}
if ($row['error_reporting'] == 4) {
    @error_reporting(E_ALL & ~E_NOTICE);
}
if ($row['error_reporting'] == 5) {
    @error_reporting(E_ALL);
}

//Displaying Errors
if ($row['display_errors'] == 1) {
    @ini_set('display_errors', '1');
} else {
    @ini_set('display_errors', '0');
}

function get_banned($ip){
  include 'config.php';
  $table = $prefix . 'bans';
  $query = $mysqli->query("SELECT * FROM '$table' WHERE ip='$ip' LIMIT 1");
  $count = mysqli_num_rows($query);
  if($count > 0){
    return 1;
  } else {
    return 0;
  }
}

function get_bannedid($ip){
  include 'config.php';
  $table = $prefix . 'bans';
  $query = $mysqli->query("SELECT * FROM '$table' WHERE ip='$ip' LIMIT 1");
  $row = mysqli_fetch_array($query);
  return $row['id'];
}
?>
