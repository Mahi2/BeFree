<?php
require("core.php");
head();

if (isset($_GET['delete-all'])) {
    $table = $prefix . 'bans';
    $query = $mysqli->query("TRUNCATE TABLE `$table`");
}

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $table = $prefix . 'bans';
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
        		      <h1 class="m-0 text-dark"><i class="fas fa-user"></i> IP Bans</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">IP Bans</li>
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
if (isset($_POST['ban-ip'])) {
    $table = $prefix . "bans";

    $ip       = addslashes(htmlspecialchars($_POST['ip']));
    $date     = date("d F Y");
    $time     = date("H:i");
    $reason   = addslashes(htmlspecialchars($_POST['reason']));
    $redirect = $_POST['redirect'];
    $url      = addslashes(htmlspecialchars($_POST['url']));

    if (!filter_var($ip, FILTER_VALIDATE_IP)) {
        echo '<br />
		<div class="alert alert-danger">
                <p><i class="fas fa-exclamation-triangle"></i> The entered <strong>IP Address</strong> is invalid.</p>
        </div>
		';
    } else if ($redirect == 1 and $url == NULL) {
        echo '<br />
		<div class="alert alert-danger">
                <p><i class="fas fa-exclamation-triangle"></i> Please enter a link to which will be redirected the banned user.</p>
        </div>
		';
    } else {
        $queryvalid = $mysqli->query("SELECT * FROM `$table` WHERE ip='$ip' LIMIT 1");
        $validator  = mysqli_num_rows($queryvalid);
        if ($validator > "0") {
            echo '<br />
		<div class="alert alert-info">
                <p><i class="fas fa-info-circle"></i> This <strong>IP Address</strong> is already banned.</p>
        </div>
		';
        } else {
            $query = $mysqli->query("INSERT INTO `$table` (`ip`, `date`, `time`, `reason`, `redirect`, `url`) VALUES ('$ip', '$date', '$time', '$reason', '$redirect', '$url')");
        }
    }
}
?>

                <div class="row">

				<div class="col-md-9">
<?php
if (isset($_GET['edit-id'])) {
    $id    = (int) $_GET["edit-id"];
    $table = $prefix . 'bans';

    if (isset($_POST['edit-ban'])) {
        $ip       = $_POST['ip'];
        $redirect = $_POST['redirect'];
        $url      = $_POST['url'];
        $reason   = $_POST['reason'];

        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            echo '<br />
		<div class="alert alert-danger">
                <p><i class="fas fa-exclamation-triangle"></i> The entered <strong>IP Address</strong> is invalid.</p>
        </div>
		';
        } else if ($redirect == 1 and $url == NULL) {
            echo '<br />
		<div class="alert alert-danger">
                <p><i class="fas fa-exclamation-triangle"></i> Please enter a link to which will be redirected the banned user.</p>
        </div>
		';
        } else {
            $update = $mysqli->query("UPDATE `$table` SET ip='$ip', redirect='$redirect', url='$url', reason='$reason' WHERE id='$id'");
        }
    }

    $result = $mysqli->query("SELECT * FROM `$table` WHERE id = '$id'");
    $row    = mysqli_fetch_assoc($result);
    if (empty($id)) {
        echo '<meta http-equiv="refresh" content="0; url=bans-ip.php">';
        exit();
    }
    if (mysqli_num_rows($result) == 0) {
        echo '<meta http-equiv="refresh" content="0; url=bans-ip.php">';
        exit();
    }
?>
<form class="form-horizontal" action="" method="post">
                    <div class="card">
						<div class="card-header">
							<h3 class="card-title">Edit - IP Address Ban #<?php
    echo $id;
?></h3>
						</div>
						<div class="card-body">
										<div class="form-group">
											<label class="control-label">IP Address: </label>
											<div class="col-sm-12">
												<input name="ip" class="form-control" type="text" value="<?php
    echo $row['ip'];
?>" required>
											</div>
										</div>
                                        <div class="form-group">
											<label class="control-label">Reason: </label>
											<div class="col-sm-12">
												<input name="reason" class="form-control" type="text" value="<?php
    echo $row['reason'];
?>">
											</div>
										</div>
                                        <div class="form-group">
											<label class="control-label">Redirecting to page / site: </label>
											<div class="col-sm-12">
	<select name="redirect" class="form-control" required>
        <option value="0" <?php
    if ($row['redirect'] == 0) {
        echo 'selected';
    }
?>>No</option>
        <option value="1" <?php
    if ($row['redirect'] == 1) {
        echo 'selected';
    }
?>>Yes</option>
    </select>
											</div>
										</div>
                                        <div class="form-group">
											<label class="control-label">Redirect URL: </label>
											<div class="col-sm-12">
												<input name="url" class="form-control" type="url" value="<?php
    echo $row['url'];
?>">
											</div>
										</div>
                                        <div class="form-group">
											<label class="control-label">Banned On: </label>
											<div class="col-sm-12">
												<input name="date" class="form-control" type="text" value="<?php
    echo $row['date'];
?>" readonly>
											</div>
										</div>
                                        <div class="form-group">
											<label class="control-label">Banned At: </label>
											<div class="col-sm-12">
												<input name="time" class="form-control" type="text" value="<?php
    echo $row['time'];
?>" readonly>
											</div>
										</div>
                                        <div class="form-group">
											<label class="control-label">AutoBanned: </label>
											<div class="col-sm-12">
												<input name="autoban" class="form-control" type="text" value="<?php
    if ($row['autoban'] == 1) {
        echo 'Yes';
    } else {
        echo 'No';
    }
?>" readonly>
											</div>
										</div>
                        </div>
                        <div class="card-footer">
							<button class="btn btn-flat btn-success" name="edit-ban" type="submit">Save</button>
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
                     </div>
				</form>
<?php
}
?>
				    <div class="card">
						<div class="card-header">
							<h3 class="card-title">Ban IP Address</h3>
						</div>
						<div class="card-body">

						<center><a href="?delete-all" class="btn btn-flat btn-danger" title="Delete all IP Bans"><i class="fas fa-trash"></i> Delete All</a></center>

<table id="dt-basic" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										  <th><i class="fas fa-list-ul"></i> ID</th>
						                  <th><i class="fas fa-user"></i> IP Address</th>
										  <th><i class="fas fa-calendar"></i> Banned On</th>
										  <th><i class="fas fa-share"></i> Redirect</th>
										  <th><i class="fas fa-magic"></i> Autobanned</th>
										  <th><i class="fas fa-cog"></i> Actions</th>
										</tr>
									</thead>
									<tbody>
<?php
$table = $prefix . 'bans';
$query = $mysqli->query("SELECT * FROM `$table`");
while ($row = $query->fetch_assoc()) {
    echo '
										<tr>
											<td>' . $row['id'] . '</td>
						                    <td>' . $row['ip'] . '</td>
										    <td>' . $row['date'] . '</td>
										    <td>';
    if ($row['redirect'] == 1) {
        echo 'Yes';
    } else {
        echo 'No';
    }
    echo '</td>
										    <td>';
    if ($row['autoban'] == 1) {
        echo 'Yes';
    } else {
        echo 'No';
    }
    echo '</td>
											<td>
                                            <a href="?edit-id=' . $row['id'] . '" class="btn btn-flat btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="?delete-id=' . $row['id'] . '" class="btn btn-flat btn-success"><i class="fas fa-trash"></i> Unban</a>
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

<?php
@$ip = $_GET['ip'];
@$reason = $_GET['reason'];
@$url = $_POST['url'];
if (empty($ip)) {
    @$ip = $_POST['ip'];
} else {
    $ip;
}
if (empty($reason)) {
    @$reason = $_POST['reason'];
} else {
    $reason;
}
?>

				<div class="col-md-3">
				     <div class="card">
						<div class="card-header">
							<h3 class="card-title">Ban IP Address</h3>
						</div>
				        <div class="card-body">
						<form class="form-horizontal" action="" method="post">
										<div class="form-group">
											<label class="control-label">IP Address: </label>
											<div class="col-sm-12">
												<input name="ip" class="form-control" type="text" value="<?php
echo $ip;
?>" required>
											</div>
										</div>
                                        <div class="form-group">
											<label class="control-label">Reason: </label>
											<div class="col-sm-12">
												<input name="reason" class="form-control" type="text" value="<?php
echo $reason;
?>">
											</div>
										</div>
                                        <div class="form-group">
											<label class="control-label">Redirecting to page / site: </label>
											<div class="col-sm-12">
	<select name="redirect" class="form-control" required>
        <option value="0" selected>No</option>
        <option value="1">Yes</option>
    </select>
											</div>
										</div>
                                        <div class="form-group">
											<label class="control-label">Redirect URL: </label>
											<div class="col-sm-12">
												<input name="url" class="form-control" type="url" value="<?php
echo $url;
?>">
											</div>
										</div>
                        </div>
                        <div class="card-footer">
							<button class="btn btn-flat btn-danger" name="ban-ip" type="submit">Ban</button>
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
