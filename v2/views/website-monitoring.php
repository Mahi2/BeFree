<?php
require("core.php");
head();

function isUp($domain)
{
    if (!filter_var($domain, FILTER_VALIDATE_URL)) {
        return false;
    }
    
    $curlInit = curl_init($domain);
    curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($curlInit, CURLOPT_HEADER, true);
    curl_setopt($curlInit, CURLOPT_NOBODY, true);
    curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($curlInit);
    
    curl_close($curlInit);
    
    if ($response)
        return true;
    
    return false;
}

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $table = $prefix . 'monitoring';
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
        		      <h1 class="m-0 text-dark"><i class="fas fa-desktop"></i> Website Monitoring</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">Website Monitoring</li>
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
if (isset($_POST['add-domain'])) {
    $table = $prefix . "monitoring";
    
    $url    = addslashes(htmlspecialchars($_POST['url']));
	$notes  = $_POST['notes'];
    
    $queryvalid = $mysqli->query("SELECT * FROM `$table` WHERE url='$url' LIMIT 1");
    $validator  = mysqli_num_rows($queryvalid);
    if ($validator > "0") {
        echo '<br />
		<div class="alert alert-info">
                <p><i class="fas fa-info-circle"></i> This <strong>Website / Domain</strong> is already added.</p>
        </div>
		';
    } else {
        $query = $mysqli->query("INSERT INTO `$table` (`url`, `notes`) VALUES ('$url', '$notes')");
    }
}
?>
                    
                <div class="row">
                    
				<div class="col-md-9">
<?php
if (isset($_GET['edit-id'])) {
    $id    = (int) $_GET["edit-id"];
    $table = $prefix . 'monitoring';
    
    if (isset($_POST['edit-domain'])) {
        $url    = addslashes(htmlspecialchars($_POST['url']));
		$notes  = $_POST['notes'];
        
        $update = $mysqli->query("UPDATE `$table` SET url='$url', notes='$notes' WHERE id='$id'");
    }
    
    $result = $mysqli->query("SELECT * FROM `$table` WHERE id = '$id'");
    $row    = mysqli_fetch_assoc($result);
    if (empty($id)) {
        echo '<meta http-equiv="refresh" content="0; url=website-monitoring.php">';
        exit();
    }
    if (mysqli_num_rows($result) == 0) {
        echo '<meta http-equiv="refresh" content="0; url=website-monitoring.php">';
        exit();
    }
?>         
<form class="form-horizontal" action="" method="post">
                    <div class="card">
						<div class="card-header">
							<h3 class="card-title">Edit - <?php
    echo $row['url'];
?></h3>
						</div>
						<div class="card-body">
                                        <div class="form-group">
											<label class="control-label">URL Address: </label>
											<div class="col-sm-12">
												<input name="url" class="form-control" type="url" value="<?php
    echo $row['url'];
?>">
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
							<button class="btn btn-flat btn-success" name="edit-domain" type="submit">Save</button>
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
                     </div>
				</form>
<?php
}
?>
				    <div class="card">
						<div class="card-header">
							<h3 class="card-title">Monitored Websites</h3>
						</div>
						<div class="card-body">
<table id="dt-basic" class="table table-strdomained table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										  <th><i class="fas fa-list-ul"></i> ID</th>
						                  <th><i class="fas fa-server"></i> URL</th>
                                          <th><i class="fas fa-dot-circle"></i> Online</th>
										  <th><i class="fas fa-file-alt"></i> Notes</th>
										  <th><i class="fas fa-cog"></i> Actions</th>
										</tr>
									</thead>
									<tbody>
<?php
$table = $prefix . 'monitoring';
$query = $mysqli->query("SELECT * FROM `$table`");
while ($row = $query->fetch_assoc()) {
    echo '
										<tr>
											<td>' . $row['id'] . '</td>
						                    <td>' . $row['url'] . '</td>
                                            <td>';
    if (isUp($row['url'])) {
        echo '<span class="badge badge-success">Yes</span>';
    } else {
        echo '<span class="badge badge-danger">No</span>';
    }
    echo '</td>
											<td>' . $row['notes'] . '</td>
											<td>
                                            <a href="' . $row['url'] . '" class="btn btn-flat btn-primary" target="_blank"><i class="fas fa-eye"></i> View</a>
                                            <a href="?edit-id=' . $row['id'] . '" class="btn btn-flat btn-warning"><i class="fas fa-edit"></i> Edit</a>
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
							<h3 class="card-title">Add Website</h3>
						</div>
				        <div class="card-body">
<form class="form-horizontal" action="" method="post">
                                        <div class="form-group">
											<label class="control-label">URL Address: </label>
											<div class="col-sm-12">
												<input name="url" class="form-control" type="url" placeholder="http://website.com" required>
											</div>
										</div>
								<div class="form-group">
											<label class="control-label">Notes: </label>
											<div class="col-sm-12">
												<textarea rows="4" name="notes" class="form-control" placeholder="Additional (descriptive) information can be added here"></textarea>
											</div>
								</div>	
                        </div>
                        <div class="card-footer">
							<button class="btn btn-flat btn-primary" name="add-domain" type="submit">Add</button>
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
				     </div>
				</div>
</form>
                    
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