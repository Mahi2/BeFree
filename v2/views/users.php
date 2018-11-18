<?php
require("core.php");
head();

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $table = $prefix . 'users';
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
        		      <h1 class="m-0 text-dark"><i class="fas fa-users"></i> Users</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">Users</li>
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
    $table    = $prefix . 'users';
    @$username = addslashes($_POST['username']);
    @$password = hash('sha256', $_POST['password']);
    
    $queryvalid = $mysqli->query("SELECT * FROM `$table` WHERE username='$username' LIMIT 1");
    $validator  = mysqli_num_rows($queryvalid);
    if ($validator > "0") {
        echo '
		<div class="alert alert-warning">
                <p><i class="fas fa-info-circle"></i> The entered <strong>Username</strong> is already used by other user.</p>
        </div>
    ';
    } else {
        $query = $mysqli->query("INSERT INTO `$table` (username, password) VALUES('$username', '$password')");
    }
}
?>
                    
                <div class="row">                  
                
				<div class="col-md-9">
<?php
if (isset($_GET['edit-id'])) {
    $id    = (int) $_GET["edit-id"];
    $table = $prefix . 'users';
    $sql   = $mysqli->query("SELECT * FROM `$table` WHERE id = '$id'");
    $row   = mysqli_fetch_assoc($sql);
    if (empty($id)) {
        echo '<meta http-equiv="refresh" content="0; url=users.php">';
    }
    if (mysqli_num_rows($sql) == 0) {
        echo '<meta http-equiv="refresh" content="0; url=users.php">';
    }
?>
<form class="form-horizontal" action="" method="post">
                    <div class="card">
						<div class="card-header">
							<h3 class="card-title">Edit User</h3>
						</div>
				        <div class="card-body">
                               <div class="form-group">
											<label class="control-label">Username: </label>
											<div class="col-sm-12">
												<input type="text" name="username" class="form-control" value="<?php
    echo $row['username'];
?>" required>
											</div>
										</div>
                                        <hr>
                                        <div class="form-group">
											<label class="control-label">New Password: </label>
											<div class="col-sm-12">
												<input type="text" name="password" class="form-control">
											</div>
										</div>
                                        <i>Fill this field only if you want to change the password.</i>
                        </div>
                        <div class="card-footer">
							<button class="btn btn-flat btn-success" name="edit" type="submit">Save</button>
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
				     </div>
</form>
<?php
    if (isset($_POST['edit'])) {
        $table    = $prefix . 'users';
        @$username = addslashes($_POST['username']);
        @$password = $_POST['password'];
        
        $query = $mysqli->query("UPDATE `$table` SET username='$username' WHERE id='$id'");
        if ($password != null) {
			$password = hash('sha256', $_POST['password']);
            $query = $mysqli->query("UPDATE `$table` SET username='$username', password='$password' WHERE id='$id'");
        }
        echo '<meta http-equiv="refresh" content="0;url=users.php">';
    }
}
?>

				    <div class="card">
						<div class="card-header">
							<h3 class="card-title">Users</h3>
						</div>
						<div class="card-body">
<table id="dt-basic" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>ID</th>
											<th>Username</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
<?php
$table = $prefix . 'users';
$query = $mysqli->query("SELECT * FROM `$table`");
while ($row = $query->fetch_assoc()) {
    echo '
										<tr>
											<td>' . $row['id'] . '</td>
                                            <td><img src="assets/img/avatar.png" width="25px" height="25px"> ' . $row['username'] . '</td>
											<td>
                                            <a href="?edit-id=' . $row['id'] . '" class="btn btn-flat btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="?delete-id=' . $row['id'] . '" class="btn btn-flat btn-danger"><i class="fas fa-trash"></i> Delete</a>
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
							<h3 class="card-title">Add User</h3>
						</div>
				        <div class="card-body">
						<form class="form-horizontal" action="" method="post">
                               <div class="form-group">
									 <label class="control-label">Username: </label>
									 <div class="col-sm-12">
								           <input type="text" name="username" class="form-control" required>
									 </div>
							   </div>
                               <div class="form-group">
									<label class="control-label">Password: </label>
									 <div class="col-sm-12">
										   <input type="password" name="password" class="form-control" required>
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