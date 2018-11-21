<?php
require("core.php");
head();

/* Purge logs older than 30 days
$datetod = strtotime(date('d F Y', strtotime('-30 days')));

$table = $prefix . 'live-traffic';
$query = $mysqli->query("SELECT id, date FROM `$table` ORDER BY id ASC");
while ($row = $query->fetch_assoc()) {
if (strtotime($row['date']) < $datetod) {
$id    = $row['id'];
$query = $mysqli->query("DELETE FROM `$table` WHERE id = '$id'");
}
}*/

if (isset($_GET['delete-all'])) {
    $table = $prefix . 'live-traffic';
    $query = $mysqli->query("TRUNCATE TABLE `$table`");
}

if (isset($_POST['save'])) {
    $table = $prefix . 'settings';

    if (isset($_POST['live_traffic'])) {
        $live_traffic = 1;
    } else {
        $live_traffic = 0;
    }

    $query = $mysqli->query("UPDATE `$table` SET live_traffic='$live_traffic' WHERE id=1");

    echo '<meta http-equiv="refresh" content="0; url=live-traffic.php" />';
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div class="content-header">

				<div class="container-fluid">
				  <div class="row mb-2">
        		    <div class="col-sm-6">
        		      <h1 class="m-0 text-dark"><i class="fas fa-globe"></i> Live Traffic</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">Live Traffic</li>
        		      </ol>
        		    </div>
        		  </div>
    			</div>
            </div>

				<!--Page content-->
				<!--===================================================-->
				<div class="content">
				<div class="container-fluid">

                <div class="row">
				<div class="col-md-12">

				<div class="card collapsed-card">
						<div class="card-header" data-widget="collapse">
							<h3 class="card-title">Live Traffic - Settings</h3>
							<div class="card-tools">
                			  <button type="button" class="btn btn-tool" data-widget="collapse">
                			    <i class="fa fa-plus"></i>
                			  </button>
                            </div>
						</div>
						<div class="card-body">
						   <form method="post">
						<div class="form-group">
												<label class="control-label">Live Traffic - Monitoring</label><br />
														      <input type="checkbox" name="live_traffic" class="psec-switch" <?php
if ($row['live_traffic'] == 1) {
    echo 'checked';
}
?> />
												     <br />Note: This module can have a small impact on the performance on some websites.<br />
                                            </div><hr />
											<button class="btn btn-flat btn-block btn-primary" name="save" type="submit">Save</button>
</form>
                        </div>
			    </div>

                <div class="card">
						<div class="card-header">
							<h3 class="card-title">Live Traffic</h3>
						</div>
						<div class="card-body">

						<center id="refresh">
						<a href="javascript:window.location.href=window.location.href" class="btn btn-flat btn-primary"><i class="fas fa-sync-alt"></i> Refresh</a>
						<a href="?delete-all" class="btn btn-flat btn-danger"><i class="fas fa-trash"></i> Delete All</a>
						</center><br />

<div class="table-responsive">
<table id="dt-basic" class="table table-sm table-bordered table-hover compact" cellspacing="0" width="100%">
									<thead class="thead-light">
										<tr>
										    <th><i class="fas fa-list"></i> ID</th>
											<th><i class="fas fa-address-card"></i> IP Address</th>
											<th><i class="fas fa-map"></i> Country</th>
											<th><i class="fas fa-globe"></i> Browser</th>
										    <th><i class="fas fa-desktop"></i> OS</th>
											<th><i class="fas fa-mobile-alt"></i> Device Type</th>
											<th><i class="fas fa-link"></i> Page</th>
											<th><i class="far fa-calendar-alt"></i> Date & Time</th>
										    <th><i class="fas fa-cogs"></i> Actions</th>
										</tr>
									</thead>
									<tbody>
<?php
$table = $prefix . 'live-traffic';
$query = $mysqli->query("SELECT * FROM `$table` ORDER BY id DESC");
while ($row = $query->fetch_assoc()) {
    echo '
										<tr>
										    <td>' . $row['id'] . '</td>
											<td>' . $row['ip'] . '
											';
    if ($row['bot'] == 1) {
        echo '<span class="badge badge-primary">Bot</span>';
    }
    echo '</td>
                                            <td><img src="assets/plugins/flags/blank.png" class="flag flag-' . strtolower($row['country_code']) . '" alt="' . $row['country'] . '" /> ' . $row['country'] . '</td>
											<td><img src="assets/img/icons/browser/' . $row['browser_code'] . '.png" /> ' . $row['browser'] . '</td>
										    <td><img src="assets/img/icons/os/' . $row['os_code'] . '.png" /> ' . $row['os'] . '</td>
										    <td>' . $row['device_type'] . '</td>
											<td>' . $row['request_uri'] . '</td>
	                                        <td>' . $row['date'] . ' at ' . $row['time'] . '</td>
											<td><a href="visitor-details.php?id=' . $row['id'] . '" class="btn btn-sm btn-flat btn-primary"><i class="fas fa-tasks"></i> Details</a></td>
										</tr>
';
}
?>
									</tbody>
								</table></div>
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
		"order": [[ 0, "desc" ]],
		"language": {
			"paginate": {
			  "previous": '<i class="fas fa-angle-left"></i>',
			  "next": '<i class="fas fa-angle-right"></i>'
			}
		}
	} );
} );

var elems = Array.prototype.slice.call(document.querySelectorAll('.psec-switch'));

elems.forEach(function(html) {
  var switchery = new Switchery(html);
});
</script>
<?php
footer();
?>
