<?php
  require("core.php");
  head();

  if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $table = $prefix . 'bans-other';
    $query = $mysqli->query("DELETE FROM `$table` WHERE id='$id'");
  }
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div class="content-header">

				<div class="container-fluid">
				  <div class="row mb-2">
        		    <div class="col-sm-6">
        		      <h1 class="m-0 text-dark"><i class="fas fa-desktop"></i> Other Bans</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">Other Bans</li>
        		      </ol>
        		    </div>
        		  </div>
    			</div>
            </div>

				<!--Page content-->
				<!--===================================================-->
				<div class="content">
				<div class="container-fluid">

<?php
if (isset($_POST['block'])) {
$table = $prefix . "bans-other";
$value = addslashes($_POST['value']);
$type  = $_POST['type'];

$queryvalid = $mysqli->query("SELECT * FROM `$table` WHERE value='$value' and type='$type' LIMIT 1");
$validator  = mysqli_num_rows($queryvalid);
if ($validator > "0") {
echo '<br />
<div class="alert alert-info">
    <p><i class="fas fa-info-circle"></i> There is already such record in the database.</p>
</div>
';
} else {
$table = $prefix . "bans-other";
$query = $mysqli->query("INSERT INTO `$table` (value, type) VALUES('$value', '$type')");
}
}
?>
