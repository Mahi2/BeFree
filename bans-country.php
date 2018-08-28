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
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div class="content-header">

				<div class="container-fluid">
				  <div class="row mb-2">
        		    <div class="col-sm-6">
        		      <h1 class="m-0 text-dark"><i class="fas fa-globe"></i> Country Bans</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">Country Bans</li>
        		      </ol>
        		    </div>
        		  </div>
    			</div>
            </div>

				<!--Page content-->
				<!--===================================================-->
				<div class="content">
				<div class="container-fluid">
?>
