<?php
  require("core.php");
  head();

  if (isset($_POST['save2'])) {
      $table = $prefix . 'badbot-settings';

      if (isset($_POST['protection'])) {
          $protection = 1;
      } else {
          $protection = 0;
      }

      if (isset($_POST['protection2'])) {
          $protection2 = 1;
      } else {
          $protection2 = 0;
      }

      if (isset($_POST['protection3'])) {
          $protection3 = 1;
      } else {
          $protection3 = 0;
      }

      $query = $mysqli->query("UPDATE `$table` SET protection='$protection', protection2='$protection2', protection3='$protection3' WHERE id=1");
  }
?>
