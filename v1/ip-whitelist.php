<?php
require("core.php");
head();

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $table = $prefix . 'ip-whitelist';
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
        		      <h1 class="m-0 text-dark"><i class="fas fa-flag"></i> IP Whitelist</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">IP Whitelist</li>
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
if (isset($_POST['add'])) {
    $table = $prefix . 'ip-whitelist';
    $ip    = addslashes(htmlspecialchars($_POST['ip']));
    $notes = addslashes(htmlspecialchars($_POST['notes']));
    if (!filter_var($ip, FILTER_VALIDATE_IP)) {
        echo '<br />
		<div class="alert alert-danger">
                <p><i class="fas fa-exclamation-triangle"></i> The entered <strong>IP Address</strong> is invalid.</p>
        </div>
		';
    } else {
        $queryvalid = $mysqli->query("SELECT * FROM `$table` WHERE ip='$ip' LIMIT 1");
        $validator  = mysqli_num_rows($queryvalid);
        if ($validator > "0") {
            echo '<br />
		<div class="alert alert-info">
                <p><i class="fas fa-info-circle"></i> This <strong>IP Address</strong> is already whitelisted.</p>
        </div>
		';
        } else {
            $query = $mysqli->query("INSERT INTO `$table` (ip, notes) VALUES('$ip', '$notes')");
        }
    }
}
?>

                <div class="row">
				<div class="col-md-9">

				<?php
if (isset($_GET['edit-id'])) {
    $id    = (int) $_GET["edit-id"];
    $table = $prefix . 'ip-whitelist';
    $sql   = $mysqli->query("SELECT * FROM `$table` WHERE id = '$id'");
    $row   = mysqli_fetch_assoc($sql);
    if (empty($id)) {
        echo '<meta http-equiv="refresh" content="0; url=ip-whitelist.php">';
    }
    if (mysqli_num_rows($sql) == 0) {
        echo '<meta http-equiv="refresh" content="0; url=ip-whitelist.php">';
    }

    if (isset($_POST['edit'])) {
        $table = $prefix . 'ip-whitelist';
        $ip    = addslashes(htmlspecialchars($_POST['ip']));
        $notes = $_POST['notes'];
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            echo '<br />
		<div class="alert alert-danger">
                <p><i class="fas fa-exclamation-triangle"></i> The entered <strong>IP Address</strong> is invalid.</p>
        </div>';
        } else {
            $queryvalid = $mysqli->query("SELECT * FROM `$table` WHERE ip='$ip' AND id != '$id' LIMIT 1");
            $validator  = mysqli_num_rows($queryvalid);
            if ($validator > "0") {
                echo '<br />
		<div class="alert alert-info">
                <p><i class="fas fa-info-circle"></i> This <strong>IP Address</strong> is already whitelisted.</p>
        </div>';
            } else {
                $query = $mysqli->query("UPDATE `$table` SET ip='$ip', `notes`='$notes' WHERE id='$id'");
				echo '<meta http-equiv="refresh" content="0; url=ip-whitelist.php">';
            }
        }
    }
?>
<form class="form-horizontal" action="" method="post">
                     <div class="card">
						<div class="card-header">
							<h3 class="card-title">Edit IP Address</h3>
						</div>
				        <div class="card-body">
								<div class="form-group">
											<label class="control-label">IP Address: </label>
											<div class="col-sm-12">
												<input type="text" name="ip" class="form-control" value="<?php
    echo $row['ip'];
?>" required>
											</div>
								</div>
								<div class="form-group">
											<label class="control-label">Notes: </label>
											<div class="col-sm-12">
												<textarea rows="4" name="notes" class="form-control" placeholder="Additional (descriptive) information can be added here"><?php
    echo $row['notes'];
?></textarea>
											</div>
								</div>
                        </div>
                        <div class="card-footer">
							<button class="btn btn-flat btn-success" name="edit" type="submit">Save</button>
				            <button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
				     </div>
</form>
<?php
}
?>

				    <div class="card">
						<div class="card-header">
							<h3 class="card-title">IP Whitelist</h3>
						</div>
						<div class="card-body">
<table id="dt-basic" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th><i class="fas fa-list-ul"></i> ID</th>
											<th><i class="fas fa-user"></i> IP Address</th>
											<th><i class="fas fa-clipboard"></i> Notes</th>
											<th><i class="fas fa-cog"></i> Actions</th>
										</tr>
									</thead>
									<tbody>
<?php
$table = $prefix . 'ip-whitelist';
$query = $mysqli->query("SELECT * FROM `$table`");
while ($row = $query->fetch_assoc()) {
    echo '
										<tr>
											<td>' . $row['id'] . '</td>
                                            <td>' . $row['ip'] . '</td>
											<td>' . $row['notes'] . '</td>
											<td>
                                            <a href="?edit-id=' . $row['id'] . '" class="btn btn-flat btn-flat btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="?delete-id=' . $row['id'] . '" class="btn btn-flat btn-flat btn-danger"><i class="fas fa-trash"></i> Delete</a>
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

				<div class="col-md-3">
				     <div class="card">
						<div class="card-header">
							<h3 class="card-title">Add IP Address</h3>
						</div>
				        <div class="card-body">
						<form class="form-horizontal" action="" method="post">
								<div class="form-group">
											<label class="control-label">IP Address: </label>
											<div class="col-sm-12">
												<input type="text" name="ip" class="form-control" required>
											</div>
							    </div>
								<div class="form-group">
											<label class="control-label">Notes: </label>
											<div class="col-sm-12">
												<textarea rows="5" name="notes" class="form-control" placeholder="Additional (descriptive) information can be added here"></textarea>
											</div>
								</div>
                        </div>
                        <div class="card-footer">
							<button class="btn btn-flat btn-primary" name="add" type="submit">Add</button>
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
				     </div>
</form>

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
} );
</script>
<?php
footer();
?>
