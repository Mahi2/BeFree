<?php
require("core.php");
head();

if (isset($_GET['id'])) {
    $id     = (int) $_GET["id"];
    $table  = $prefix . 'logs';
    $result = $mysqli->query("SELECT * FROM `$table` WHERE id = '$id'");
    $row    = mysqli_fetch_assoc($result);
    if (empty($id)) {
        echo '<meta http-equiv="refresh" content="0; url=all-logs.php">';
        exit();
    }
    if (mysqli_num_rows($result) == 0) {
        echo '<meta http-equiv="refresh" content="0; url=all-logs.php">';
        exit();
    }
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div class="content-header">

				<div class="container-fluid">
				  <div class="row mb-2">
        		    <div class="col-sm-6">
        		      <h1 class="m-0 text-dark"><i class="fas fa-align-justify"></i> Log Details</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">Log Details</li>
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
				    <div class="card">
						<div class="card-header">
							<h3 class="card-title">Details for Log #<?php
    echo $row['id'];
?></h3>
						</div>
						<div class="card-body">
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">
                                                        <i class="fas fa-user"></i> IP Address
                                                    </label>
													<input type="text" class="form-control" value="<?php
    echo $row['ip'];
?>" readonly>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">
                                                        <i class="fas fa-calendar"></i> Date & Time
                                                    </label>
													<input type="text" class="form-control" value="<?php
    echo '' . $row['date'] . ' at ' . $row['time'] . '';
?>" readonly>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">
                                                         <i class="fas fa-globe"></i> Browser
                                                    </label>
                                                    <div class="input-group mar-btm">
											            <span class="input-group-addon">
                                                            <img src="assets/img/icons/browser/<?php
    echo $row['browser_code'];
?>.png" />
                                                        </span>
													   <input type="text" class="form-control" value="<?php
    echo $row['browser'];
?>" readonly>
                                                    </div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">
                                                         <i class="fas fa-desktop"></i> Operating System
                                                    </label>
                                                    <div class="input-group mar-btm">
											            <span class="input-group-addon">
                                                            <img src="assets/img/icons/os/<?php
    echo $row['os_code'];
?>.png" />
                                                        </span>
                                                        <input type="text" class="form-control" value="<?php
    echo $row['os'];
?>" readonly>
                                                    </div>
												</div>
											</div>
										</div>
                                        <div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">
                                                         <i class="fas fa-map"></i> Country
                                                    </label>
                                                    <div class="input-group mar-btm">
											            <span class="input-group-addon">
                                                            <img src="assets/plugins/flags/blank.png" class="flag flag-<?php
    echo strtolower($row['country_code']);
?>" alt="<?php
    echo $row['country'];
?>" />
                                                        </span>
                                                        <input type="text" class="form-control" value="<?php
    echo $row['country'];
?>" readonly>
                                                    </div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">
                                                         <i class="fas fa-map-pin"></i> Region
                                                    </label>
													<input type="text" class="form-control" value="<?php
    echo $row['region'];
?>" readonly>
												</div>
											</div>
										</div>
                                        <div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">
                                                         <i class="fas fa-map"></i> City
                                                    </label>
													<input type="text" class="form-control" value="<?php
    echo $row['city'];
?>" readonly>
												</div>
											</div>
                                            <div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">
                                                         <i class="fas fa-cloud"></i> Internet Service Provider
                                                    </label>
													<input type="text" class="form-control" value="<?php
    echo $row['isp'];
?>" readonly>
												</div>
											</div>
										</div>
                                        <div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">
                                                        <i class="fas fa-bomb"></i> Threat Type
                                                    </label>
													<input type="text" class="form-control" value="<?php
    echo $row['type'];
?>" readonly>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">
                                                        <i class="fas fa-ban"></i> Banned
                                                    </label>
													<input type="text" class="form-control" value="<?php
    if (get_banned($row['ip']) == 0) {
        echo 'No';
    } else {
        echo 'Yes';
    }
?>" readonly>
												</div>
											</div>
										</div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                            <div class="form-group">
												<label class="control-label">
                                                    <i class="fas fa-reply"></i> Referer URL
                                                </label>
                                                <input type="text" class="form-control" value="<?php
    echo $row['referer_url'];
?>" readonly>
                                            </div>
                                            </div>
                                            <div class="col-sm-8">
                                            <div class="form-group">
												<label class="control-label">
                                                    <i class="fas fa-user-secret"></i> User Agent
                                                </label>
                                                <textarea placeholder="User Agent" rows="2" class="form-control" readonly><?php
    echo $row['useragent'];
?></textarea>
                                            </div>
                                            </div>
										</div>
                                        <hr>
                                        <div class="row">
											<div class="col-sm-4">
                                            <div class="form-group">
												<label class="control-label">
                                                    <i class="fas fa-file-alt"></i> Attacked Page
                                                </label>
                                                <input type="text" class="form-control" value="<?php
    echo $row['page'];
?>" readonly>
                                            </div>
                                            </div>
                                            <div class="col-sm-8">
                                            <div class="form-group">
												<label class="control-label">
                                                    <i class="fas fa-code"></i> Query used for the attack
                                                </label>
                                                <textarea placeholder="Query" rows="2" class="form-control" readonly><?php
    echo $row['query'];
?></textarea>
                                            </div>
                                            </div>
										</div>

                                        <hr>

                                        <label class="control-label">
                                            <i class="fas fa-location-arrow"></i> Possible Location
                                        </label>
									    <center><div id="mapdiv" style="width: 99%; height:450px"></div></center>

									</div>
									<div class="card-footer">
<?php
    if (get_banned($row['ip']) == 1) {
        echo '
										    <a href="bans-ip.php?delete-id=' . get_bannedid($row['ip']) . '" class="btn btn-flat btn-success"><i class="fas fa-ban"></i> Unban</a>
									        ';
    } else {
        echo '
										    <a href="bans-ip.php?ip=' . $row['ip'] . '&reason=' . $row['type'] . '" class="btn btn-flat btn-warning"><i class="fas fa-ban"></i> Ban</a>
									        ';
    }
    echo '
											<a href="all-logs.php?delete-id=' . $row['id'] . '" class="btn btn-flat btn-danger"><i class="fas fa-times"></i> Delete</a>
';
?>
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
  map = new OpenLayers.Map("mapdiv");
  map.addlayer(new OpenLayers.Layer.OSM());

  var lonLat = new OpenLayers.LonLat( <?php
    echo $row['longitude'];
    ?>, <?php
    echo $row['latitude'];
    ?>)
      .transform(
        new OpenLayers.Projection("EPSG:4326"),
        map.getProjectionObject()
      );

      var zoom=18;
      var markers = new OpenLayers.Layer.Markers("Markers");

      map.addlayer(markers);
      markers.addMarker(new OpenLayers.Marker(lonLat));
      map.setCenter (lonLat, zoom);
</script>
<?php
    footer();
} else {
    echo '<meta http-equiv="refresh" content="0; url=all-logs.php">';
    exit();
}
?>
