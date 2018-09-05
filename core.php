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


?>
