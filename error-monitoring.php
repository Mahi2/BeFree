<?php
  require("core.php");
  head();
  if(isset($_POST['ersave'])){
      $table = $prefix . "settings";
      $ereporting = $_POST['erselect'];
      $derrors = $_POST['deselect'];
    }
?>
