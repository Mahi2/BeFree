<?php
include "core.php";
head();

$database_host     = $_SESSION['database_host'];
$database_username = $_SESSION['database_username'];
$database_password = $_SESSION['database_password'];
$database_name     = $_SESSION['database_name'];
$table_prefix      = $_SESSION['table_prefix'];
$username          = $_SESSION['username'];
$password          = hash('sha256', $_SESSION['password']);

if (isset($_SERVER['HTTPS'])) {
    $htp = 'https';
} else {
    $htp = 'http';
}
$site_url             = $htp . '://' . $_SERVER['SERVER_NAME'];
$fullpath             = "$htp://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$projectsecurity_path = substr($fullpath, 0, strpos($fullpath, '/install'));

@$db = new mysqli($database_host, $database_username, $database_password, $database_name);
if ($db) {

    //Importing SQL Tables
    $query = '';

    $sql_dump = file('sql/database.sql');

    $sql_dump = str_replace("<DB_PREFIX>", $table_prefix, $sql_dump);
    $sql_dump = str_replace("<PROJECTSECURITY_PATH>", $projectsecurity_path, $sql_dump);

    foreach ($sql_dump as $line) {

        $startWith = substr(trim($line), 0, 2);
        $endWith   = substr(trim($line), -1, 1);

        if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
            continue;
        }

        $query = $query . $line;
        if ($endWith == ';') {
            mysqli_query($db, $query) or die('Problem in executing the SQL query <b>' . $query . '</b>');
            $query = '';
        }
    }

      // Config file creating and writing information
      $config_file = file_get_contents(CONFIG_FILE_TEMPLATE);
      $config_file = str_replace("<DB_HOST>", $database_host, $config_file);
      $config_file = str_replace("<DB_NAME>", $database_name, $config_file);
      $config_file = str_replace("<DB_USER>", $database_username, $config_file);
      $config_file = str_replace("<DB_PASSWORD>", $database_password, $config_file);
      $config_file = str_replace("<DB_PREFIX>", $table_prefix, $config_file);
      $config_file = str_replace("<PROJECTSECURITY_PATH>", $projectsecurity_path, $config_file);
      $config_file = str_replace("<SITE_URL>", $site_url, $config_file);

      $link  = new mysqli($database_host, $database_username, $database_password, $database_name);
      $table = $table_prefix . 'users';
      $query = mysqli_query($link, "INSERT INTO `$table` (id, username, password) VALUES ('1', '$username', '$password')");

      @chmod(CONFIG_FILE_PATH, 0777);
      @$f = fopen(CONFIG_FILE_PATH, "w+");
      if (!fwrite($f, $config_file) > 0) {
          echo 'Cannot open the configuration file to save the information';
      }
      fclose($f);

  } else {
      echo _lang("error_check_db_connection");
  }
  ?>
  <center>
  <div class="alert alert-success">
  <?php
  echo _lang("success_install");
  ?>
  </div>

  <div class="alert alert-warning">
  <?php
  echo _lang("alert_remove_files");
  ?>
  </div>

  <div class="alert alert-info">
  <?php
  echo _lang("put_code");
  ?>
  <br /><br />
  	<kbd>
  	    include_once "projectsecurity_folder/config.php";<br />
  	    include_once "projectsecurity_folder/project-security.php";
  	</kbd>
  </div>

  <a href="../" class="btn-success btn"><i class="fas fa-arrow-circle-right"></i> <?php
  echo _lang("proceed");
  ?></a>
  </center>
  <?php
  footer();
  ?>
