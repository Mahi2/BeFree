<?php
require("core.php");
head();

if (isset($_POST['save'])) {
    $table = $prefix . 'tor-settings';
    
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
$table = $prefix . 'tor-settings';
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
							<h3 class="card-title">Tor Detection - Security Module</h3>
						</div>
						<div class="card-body jumbotron">
<?php
if ($row['protection'] == 1) {
    echo '
        <h1 style="color: #47A447;"><i class="fas fa-check-circle"></i> Enabled</h1>
        <p>The website is protected from <strong>Tor Visitors</strong></p>
';
} else {
    echo '
        <h1 style="color: #d2322d;"><i class="fas fa-times-circle"></i> Disabled</h1>
        <p>The website is not protected from <strong>Tor Visitors</strong></p>
';
}
?>
                            </div>
                        </div>
						
						
                        <div class="card">
                        	<div class="card-header">
								<h3 class="card-title">What is Tor</h3>
							</div>
							<div class="card-body">
                        	    <strong>"Tor is free software and an open network that helps you defend against traffic analysis, a form of network surveillance that threatens personal freedom and privacy, confidential business activities and relationships, and state security."</strong>
                                <br /><br />
                                TOR works much like the Open Proxies, however it's mostly used by legitimate visitors who just want to remain anonymous in Internet. Note that it can be abused by malicious visitors.
                        	</div>
                        </div>
						
                    </div>
                    
                    <div class="col-md-4">
						
<form class="form-horizontal form-bordered" action="" method="post">
                        <div class="card">
                        	<div class="card-header">
								<h3 class="card-title">Settings</h3>
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
							    <button class="btn btn-flat btn-block btn-primary" name="save" type="submit"><i class="fas fa-floppy"></i> Save</button>
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