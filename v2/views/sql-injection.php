<?php
require("core.php");
head();

if (isset($_POST['save2'])) {
    $table = $prefix . 'sqli-settings';
    
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
    
    if (isset($_POST['protection4'])) {
        $protection4 = 1;
    } else {
        $protection4 = 0;
    }
    
    if (isset($_POST['protection5'])) {
        $protection5 = 1;
    } else {
        $protection5 = 0;
    }
    
    if (isset($_POST['protection6'])) {
        $protection6 = 1;
    } else {
        $protection6 = 0;
    }
    
    if (isset($_POST['protection7'])) {
        $protection7 = 1;
    } else {
        $protection7 = 0;
    }
	
	if (isset($_POST['protection8'])) {
        $protection8 = 1;
    } else {
        $protection8 = 0;
    }
    
    $query = $mysqli->query("UPDATE `$table` SET protection2='$protection2', protection3='$protection3', protection4='$protection4', protection5='$protection5', protection5='$protection5', protection6='$protection6', protection7='$protection7', protection8='$protection8' WHERE id=1");
}

if (isset($_POST['save'])) {
    $table = $prefix . 'sqli-settings';
    
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
$table = $prefix . 'sqli-settings';
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
							<h3 class="card-title">SQL Injection - Security Module</h3>
						</div>
						<div class="card-body jumbotron">
<?php
if ($row['protection'] == 1) {
    echo '
        <h1 style="color: #47A447;"><i class="fas fa-check-circle"></i> Enabled</h1>
        <p>The website is protected from <strong>SQL Injection Attacks (SQLi)</strong></p>
';
} else {
    echo '
        <h1 style="color: #d2322d;"><i class="fas fa-times-circle"></i> Disabled</h1>
        <p>The website is not protected from <strong>SQL Injection Attacks (SQLi)</strong></p>
';
}
?>
                        </div>
                    </div>
                    
                    <form class="form-horizontal form-bordered" action="" method="post">
                    
                        <div class="card">
                        	<div class="card-header">
								<h3 class="card-title">Additional Security Modules</h3>
							</div>
							<div class="card-body">
                        	    <div class="row">
                                    <div class="col-md-4">
                                        <div class="card card-body bg-light">
                                        <center>
                                        <h5>XSS Protection</h5>
                                        Sanitizes infected requests
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
                                        <h5>Clickjacking Protection</h5>
                                        Detecting and blocking clickjacking attempts
                                        <br /><br />
                                        
											<input type="checkbox" name="protection3" class="psec-switch" <?php
if ($row['protection3'] == 1) {
    echo 'checked="checked"';
}
?> />
                                        </center>
                                        </div>
                                    </div>
									<div class="col-md-4">
                                        <div class="card card-body bg-light">
                                        <center>
                                        <h5>Hide PHP Information</h5>
                                        Hides the PHP version to remote requests
                                        <br /><br />
                                        
											<input type="checkbox" name="protection6" class="psec-switch" <?php
if ($row['protection6'] == 1) {
    echo 'checked="checked"';
}
?> />
                                        </center>
                                        </div>
                                    </div>
								</div>
								<div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-body bg-light">
                                        <center>
                                        <h5>MIME Mismatch Attacks Protection</h5>
                                        Prevents attacks based on MIME-type mismatch
                                        <br /><br />
                                        
											<input type="checkbox" name="protection4" class="psec-switch" <?php
if ($row['protection4'] == 1) {
    echo 'checked="checked"';
}
?> />
                                        </center>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card card-body bg-light">
                                        <center>
                                        <h5>Secure Connection</h5>
                                        Forces the website to use secure connection (HTTPS)
                                        <br /><br />
                                        
											<input type="checkbox" name="protection5" class="psec-switch" <?php
if ($row['protection5'] == 1) {
    echo 'checked="checked"';
}
?> />
                                        </center>
                                        </div>
                                    </div>
								</div>
								<div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-body bg-light">
                                        <center>
                                        <h5>Data Filtering</h5>
                                        Basic Sanitization of all fields, inputs, forms and requests. Low sensativity but faster performance.
                                        <br /><br />
                                        
											<input type="checkbox" name="protection7" class="psec-switch" <?php
if ($row['protection7'] == 1) {
    echo 'checked="checked"';
}
?> />
                                        </center>
                                        </div>
                                    </div>
									<div class="col-md-6">
                                        <div class="card card-body bg-light">
                                        <center>
                                        <h5>Requests Sanitization</h5>
                                        Advanced Sanitization of all fields, inputs, forms and requests. High sensativity but slower performance.
                                        <br /><br />
                                        
											<input type="checkbox" name="protection8" class="psec-switch" <?php
if ($row['protection8'] == 1) {
    echo 'checked="checked"';
}
?> />
                                        </center>
                                        </div>
                                    </div>
								</div>
                                    <center><button class="btn btn-flat btn-md btn-block btn-primary" name="save2" type="submit"><i class="fas fa-floppy"></i> Save</button></center>
                        	</div>
                        </div>
                    
                    </form>
                </div>
                    
                <div class="col-md-4">
                     <div class="card">
                        	<div class="card-header">
								<h3 class="card-title">What is SQL Injection</h3>
							</div>
							<div class="card-body">
                                <strong>SQL Injection</strong> is a technique where malicious users can inject SQL commands into an SQL statement, via web page input. Injected SQL commands can alter SQL statement and compromise the security of a web application.
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