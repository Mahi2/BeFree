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

<div class="row">

<div class="col-md-6">
<div class="card">
<div class="card-header">
<h3 class="card-title">Ban Browser, OS or ISP</h3>
</div>
<div class="card-body">
<form class="form-horizontal" action="" method="post">
  <div class="form-group">
    <label class="control-label">Browser, OS or ISP Name: </label>
    <div class="col-sm-12">
      <input name="value" class="form-control" type="text" required>
    </div>
  </div>
                      <div class="form-group">
    <label class="control-label">Type: </label>
    <div class="col-sm-12">
<select name="type" class="form-control" required>
<option value="browser" selected>Browser</option>
<option value="os">Operating System</option>
<option value="isp">Internet Service Provider</option>
<option value="referrer">Referrer</option>
</select>
    </div>
  </div>
      </div>
      <div class="card-footer">
<button class="btn btn-flat btn-danger" name="block" type="submit">Block</button>
<button type="reset" class="btn btn-flat btn-default">Reset</button>
</div>
</div>
</div>
</form>

  <div class="col-md-6">
<div class="card">
<div class="card-header">
<h3 class="card-title">Blocked <strong>Internet Service Providers</strong></h3>
</div>
<div class="card-body">
<table id="dt-basic3" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
<thead>
  <tr>
            <th><i class="fas fa-globe"></i> Browser</th>
    <th><i class="fas fa-cog"></i> Actions</th>
  </tr>
</thead>
<tbody>
<?php
$table = $prefix . 'bans-other';
$query = $mysqli->query("SELECT * FROM `$table` WHERE type='isp'");
while ($row = $query->fetch_assoc()) {
echo '
  <tr>
              <td>' . $row['value'] . '</td>
    <td>
                          <a href="?delete-id=' . $row['id'] . '" class="btn btn-flat btn-success"><i class="fas fa-unlock"></i> Unblock</a>
    </td>
  </tr>
';
}
?>
</tbody>
</table>
      </div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="card">
<div class="card-header">
<h3 class="card-title">Blocked <strong>Browsers</strong></h3>
</div>
<div class="card-body">
<table id="dt-basic" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
<thead>
  <tr>
            <th><i class="fas fa-globe"></i> Browser</th>
    <th><i class="fas fa-cog"></i> Actions</th>
  </tr>
</thead>
<tbody>
<?php
$table = $prefix . 'bans-other';
$query = $mysqli->query("SELECT * FROM `$table` WHERE type='browser'");
while ($row = $query->fetch_assoc()) {
echo '
  <tr>
              <td>' . $row['value'] . '</td>
    <td>
                          <a href="?delete-id=' . $row['id'] . '" class="btn btn-flat btn-success"><i class="fas fa-unlock"></i> Unblock</a>
    </td>
  </tr>
';
}
?>
</tbody>
</table>
      </div>
   </div>
</div>

<div class="col-md-6">
<div class="card">
<div class="card-header">
<h3 class="card-title">Blocked <strong>Operating Systems</strong></h3>
</div>
<div class="card-body">
<table id="dt-basic2" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
<thead>
  <tr>
            <th><i class="fas fa-globe"></i> Browser</th>
    <th><i class="fas fa-cog"></i> Actions</th>
  </tr>
</thead>
<tbody>
<?php
$table = $prefix . 'bans-other';
$query = $mysqli->query("SELECT * FROM `$table` WHERE type='os'");
while ($row = $query->fetch_assoc()) {
echo '
  <tr>
              <td>' . $row['value'] . '</td>
    <td>
                          <a href="?delete-id=' . $row['id'] . '" class="btn btn-flat btn-success"><i class="fas fa-unlock"></i> Unblock</a>
    </td>
  </tr>
';
}
?>
</tbody>
</table>
      </div>
</div>
</div>

<div class="col-md-6">
<div class="card">
<div class="card-header">
<h3 class="card-title">Blocked <strong>Referrers</strong></h3>
</div>
<div class="card-body">
<table id="dt-basic4" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
<thead>
  <tr>
            <th><i class="fas fa-link"></i> Referrer</th>
    <th><i class="fas fa-cog"></i> Actions</th>
  </tr>
</thead>
<tbody>
<?php
$table = $prefix . 'bans-other';
$query = $mysqli->query("SELECT * FROM `$table` WHERE type='referrer'");
while ($row = $query->fetch_assoc()) {
echo '
  <tr>
              <td>' . $row['value'] . '</td>
    <td>
                          <a href="?delete-id=' . $row['id'] . '" class="btn btn-flat btn-success"><i class="fas fa-unlock"></i> Unblock</a>
    </td>
  </tr>
';
}
?>
</tbody>
</table>
      </div>
</div>
</div>
</div>

</div>
</div>
<!--===================================================-->
<!--End page content-->

</div>
<!--===================================================-->
<!--END CONTENT CONTAINER-->
</div>
<script>
$(document).ready(function() {
$('#dt-basic').dataTable( {
  "responsive": true,
  "language": {
    "paginate": {
      "previous": '<i class="fas fa-angle-left"></i>',
      "next": '<i class="fas fa-angle-right"></i>'
    }
  }
} );

$('#dt-basic2').dataTable( {
  "responsive": true,
  "language": {
    "paginate": {
      "previous": '<i class="fas fa-angle-left"></i>',
      "next": '<i class="fas fa-angle-right"></i>'
    }
  }
} );

$('#dt-basic3').dataTable( {
		"responsive": true,
		"language": {
			"paginate": {
			  "previous": '<i class="fas fa-angle-left"></i>',
			  "next": '<i class="fas fa-angle-right"></i>'
			}
		}
	} );

  $('#dt-basic4').dataTable( {
  		"responsive": true,
  		"language": {
  			"paginate": {
  			  "previous": '<i class="fas fa-angle-left"></i>',
  			  "next": '<i class="fas fa-angle-right"></i>'
  			}
  		}
  	} );
  } );
</script>
<?php
footer();
?>
