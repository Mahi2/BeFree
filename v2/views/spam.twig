<?php
require("core.php");
head();

if (isset($_POST['add-database'])) {
    $table      = $prefix . 'dnsbl-databases';
    $database   = $_POST['database'];
    $queryvalid = $mysqli->query("SELECT * FROM `$table` WHERE `database`='$database' LIMIT 1");
    $validator  = mysqli_num_rows($queryvalid);
    if ($validator > "0") {
    } else {
        $query = $mysqli->query("INSERT INTO `$table` (`database`) VALUES ('$database')");
    }
}

if (isset($_GET['delete-id'])) {
    $id    = (int) $_GET["delete-id"];
    $table = $prefix . 'dnsbl-databases';
    $query = $mysqli->query("DELETE FROM `$table` WHERE id='$id'");
}

if (isset($_POST['save'])) {
    $table = $prefix . 'spam-settings';
    
    if (isset($_POST['protection'])) {
        $protection = 1;
    } else {
        $protection = 0;
    }
    
    if (isset($_POST['logging'])) {
        $logging = 1;
    } else {
        $logging = 0;
    }
    
    if (isset($_POST['autoban'])) {
        $autoban = 1;
    } else {
        $autoban = 0;
    }
    
    if (isset($_POST['mail'])) {
        $mail = 1;
    } else {
        $mail = 0;
    }
    
    $redirect = $_POST['redirect'];
    
    $query = $mysqli->query("UPDATE `$table` SET protection='$protection', logging='$logging', autoban='$autoban', mail='$mail', redirect='$redirect' WHERE id=1");
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div class="content-header">
				
				<div class="container-fluid">
				  <div class="row mb-2">
        		    <div class="col-sm-6">
        		      <h1 class="m-0 text-dark"><i class="fas fa-code"></i> Security Module</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">Security Module</li>
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
				<div class="col-md-8">
                    	    
<?php
$table = $prefix . 'spam-settings';
$query = $mysqli->query("SELECT * FROM `$table`");
$row   = mysqli_fetch_array($query);
if ($row['protection'] == 1) {
    echo '
              <div class="card card-solid card-success">
';
} else {
    echo '
              <div class="card card-solid card-danger">
';
}
?>
						<div class="card-header">
							<h3 class="card-title">Spam - Security Module</h3>
						</div>
						<div class="card-body jumbotron">
<?php
if ($row['protection'] == 1) {
    echo '
        <h1 style="color: #47A447;"><i class="fas fa-check-circle"></i> Enabled</h1>
        <p>The website is protected from <strong>Spammers</strong></p>
';
} else {
    echo '
        <h1 style="color: #d2322d;"><i class="fas fa-times-circle"></i> Disabled</h1>
        <p>The website is not protected from <strong>Spammers</strong></p>
';
}
?>
                        </div>
                    </div>
                    
                    <div class="card">
						<div class="card-header">
							<h3 class="card-title">Spam Databases (DNSBL)</h3>
						</div>
						<div class="card-body">

                                    <center><button data-target="#add" data-toggle="modal" class="btn btn-flat btn-primary btn-md"><i class="fas fa-plus-circle"></i> Add Spam Database (DNSBL)</button></center>
                                    <br />
									
<form class="form-horizontal mb-lg" method="POST">
    <div class="modal fade" id="add" role="dialog" tabindex="-1" aria-labelledby="add" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
										  <!--Modal header-->
										  <div class="modal-header">
										  <h5 class="modal-title">Add Spam Database (DNSBL)</h5>
										  <button data-dismiss="modal" class="close" type="button">
										  <span aria-hidden="true">&times;</span>
										  </button>
										  </div>
											<div class="modal-body">
												<div class="form-group">
                                                        <label class="control-label">Spam Database (DNSBL):</label>
														<div class="col-sm-12">
															<input type="text" class="form-control" name="database" required/>
														</div>
												</div>
											</div>
								            <!--Modal footer-->
				                            <div class="modal-footer">
												<div class="row">
													<div class="float-left">
									                    <input class="btn btn-flat btn-primary" name="add-database" type="submit" value="Add">
													</div>&nbsp;
                                                    <div class="float-right">
														<button data-dismiss="modal" class="btn btn-flat btn-default" type="button">Close</button>
													</div>
												</div>
											</div>
										
									</div>
        </div>
    </div>
                                    </form>
<div class="table-responsive">                
<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>DNSBL Database</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
<?php
$table = $prefix . 'dnsbl-databases';
$query = $mysqli->query("SELECT * FROM `$table`");
while ($rowd = $query->fetch_assoc()) {
    echo '
										<tr>
                                            <td>' . $rowd['database'] . '</td>
											<td>
                                            <a href="?delete-id=' . $rowd['id'] . '" class="btn btn-flat btn-danger"><i class="fas fa-trash"></i> Delete</a>
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
                    
                <div class="col-md-4">
                     <div class="card">
                        	<div class="card-header">
								<h3 class="card-title">What is Spam & DNSBL</h3>
							</div>
							<div class="card-body">
                                <strong>Electronic Spamming</strong> is the use of electronic messaging systems to send unsolicited messages (spam), especially advertising, as card card-body bg-light as sending messages repeatedly on the same site.
                                <br /><br />
                                A <strong>DNS-based Blackhole List (DNSBL)</strong> or <strong>Real-time Blackhole List (RBL)</strong> is a list of IP addresses which are most often used to publish the addresses of computers or networks linked to spamming.<br /><br />
                                    
                                All <strong>Blacklists</strong> can be found here: <strong><a href="https://www.dnsbl.info/dnsbl-list.php" target="_blank">https://www.dnsbl.info/dnsbl-list.php</a></strong>
                        	</div>
                     </div>
                     <div class="card">
                        	<div class="card-header">
								<h3 class="card-title">Module Settings</h3>
							</div>
							<div class="card-body">
									<ul class="list-group">
<form class="form-horizontal form-bordered" action="" method="post">
										<li class="list-group-item">
											<p>Protection</p>
														<input type="checkbox" name="protection" class="psec-switch" <?php
if ($row['protection'] == 1) {
    echo 'checked="checked"';
}
?> /><br />
											<span class="text-muted">If this security module is enabled all threats of this type will be blocked</span>
										</li>
										<li class="list-group-item">
											<p>Logging</p>
														<input type="checkbox" name="logging" class="psec-switch" <?php
if ($row['logging'] == 1) {
    echo 'checked="checked"';
}
?> /><br />
											<span class="text-muted">Logging every threat of this type</span>
										</li>
										<li class="list-group-item">
											<p>AutoBan</p>
														<input type="checkbox" name="autoban" class="psec-switch" <?php
if ($row['autoban'] == 1) {
    echo 'checked="checked"';
}
?> /><br />
											<span class="text-muted">Automatically ban anyone who is detected as this type of threat</span>
										</li>
                                        <li class="list-group-item">
											<p>Mail Notifications</p>
														<input type="checkbox" name="mail" class="psec-switch" <?php
if ($row['mail'] == 1) {
    echo 'checked="checked"';
}
?> /><br />
											<span class="text-muted">You will receive email notification when threat of this type is detected</span>
										</li>
                                        <li class="list-group-item">
											<p>Redirect URL</p>
											<input name="redirect" class="form-control" type="text" value="<?php
echo $row['redirect'];
?>" required>
										</li>
									</ul>
                        	</div>
                            <div class="card-footer">
                                <button class="btn btn-flat btn-block btn-primary mar-top" name="save" type="submit"><i class="fas fa-floppy"></i> Save</button>
                            </div>
</form>
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
var elems = Array.prototype.slice.call(document.querySelectorAll('.psec-switch'));

elems.forEach(function(html) {
  var switchery = new Switchery(html);
});
</script>
<?php
footer();
?>