<?php
require("core.php");
head();

if (isset($_POST['save2'])) {
    $table = $prefix . 'proxy-settings';
    
    if (isset($_POST['protection'])) {
        $protection = 1;
    } else {
        $protection = 0;
    }
    
    if (isset($_POST['protection2'])) {
        $protection2 = 1;
    } else {
        $protection2 = 0;
    }
    
    if (isset($_POST['protection3'])) {
        $protection3 = 1;
    } else {
        $protection3 = 0;
    }
    
    $query = $mysqli->query("UPDATE `$table` SET protection='$protection', protection2='$protection2', protection3='$protection3' WHERE id=1");
}

if (isset($_POST['save'])) {
    $table = $prefix . 'proxy-settings';
    
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
    
    $query = $mysqli->query("UPDATE `$table` SET logging='$logging', autoban='$autoban', mail='$mail', redirect='$redirect' WHERE id=1");
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
$table = $prefix . 'proxy-settings';
$query = $mysqli->query("SELECT * FROM `$table`");
$row   = mysqli_fetch_array($query);
if ($row['protection'] == 1 OR $row['protection2'] == 1 OR $row['protection3'] == 1) {
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
							<h3 class="card-title">Proxy - Security Module</h3>
						</div>
						<div class="card-body jumbotron">
<?php
if ($row['protection'] == 1 OR $row['protection2'] == 1 OR $row['protection3'] == 1) {
    echo '
        <h1 style="color: #47A447;"><i class="fas fa-check-circle"></i> Enabled</h1>
        <p>The website is protected from <strong>Proxies</strong></p>
';
} else {
    echo '
        <h1 style="color: #d2322d;"><i class="fas fa-times-circle"></i> Disabled</h1>
        <p>The website is not protected from <strong>Proxies</strong></p>
';
}
?>
                        </div>
                    </div>
                    
                        <div class="card">
                        	<div class="card-header">
								<h3 class="card-title">Proxy Detection Methods</h3>
							</div>
							<div class="card-body">
							<form class="form-horizontal form-bordered" action="" method="post">
                        	    <div class="row">
                                    <div class="col-md-4">
                                        <div class="card card-body bg-light">
                                        <center>
                                        <h5>Detection Method #1</h5>
                                        Connects with Proxy API and verifies if the visitor is using a Proxy
                                        <br /><br />
                                        
											<input type="checkbox" name="protection" class="psec-switch" <?php
if ($row['protection'] == 1) {
    echo 'checked="checked"';
}
?> />
                                        </center>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card-body bg-light">
                                        <center>
                                        <h5>Detection Method #2</h5>
                                        Checks the visitor's HTTP Headers for Proxy Elements
                                        <br /><br />
                                        
											<input type="checkbox" name="protection2" class="psec-switch" <?php
if ($row['protection2'] == 1) {
    echo 'checked="checked"';
}
?> />
                                        </center>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card-body bg-light">
                                        <center>
                                        <h5>Detection Method #3</h5>
                                        Scans the visitor's ports to detect if it is behind a Proxy or not.
                                        This Proxy Detection Method is used mainly to detect and block online proxy websites.<br />
                                        <strong>(False-Positives are possible)</strong>
                                        <br /><br />
                                        
											<input type="checkbox" name="protection3" class="psec-switch" <?php
if ($row['protection3'] == 1) {
    echo 'checked="checked"';
}
?> />
								        </div>
                                        </center>
                                        </div>
                                    </div>
                                    <center><button class="btn btn-flat btn-md btn-block btn-primary mar-top" name="save2" type="submit"><i class="fas fa-floppy"></i> Save</button></center>
                                </div>
                        	</div>
                    </form>
                    
                </div>
                    
                <div class="col-md-4">
                     <div class="card">
                        	<div class="card-header">
								<h3 class="card-title">What is Proxy</h3>
							</div>
							<div class="card-body">
                                <strong>Proxy</strong> or <strong>Proxy Server</strong> is basically another computer which serves as a hub through which internet requests are processed. By connecting through one of these servers, your computer sends your requests to the proxy server which then processes your request and returns what you were wanting.
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