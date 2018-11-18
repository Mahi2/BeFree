<?php
require("core.php");
head();

if (isset($_POST['update'])) {
    $text = addslashes(htmlentities($_POST['text']));
    
    $text2 = addslashes(htmlentities($_POST['text2']));
    
    $text3 = addslashes(htmlentities($_POST['text3']));
    
    $text4 = addslashes(htmlentities($_POST['text4']));
    
    $text5 = addslashes(htmlentities($_POST['text5']));
    
    $text6 = addslashes(htmlentities($_POST['text6']));
    
    $text7 = addslashes(htmlentities($_POST['text7']));
    
    $text8 = addslashes(htmlentities($_POST['text8']));
    
    $text9 = addslashes(htmlentities($_POST['text9']));
    
    $text10 = addslashes(htmlentities($_POST['text10']));
    
    $text11 = addslashes(htmlentities($_POST['text11']));
    
    $text12 = addslashes(htmlentities($_POST['text12']));
    
    $text13 = addslashes(htmlentities($_POST['text13']));
    
    $text14 = addslashes(htmlentities($_POST['text14']));
    
    $table         = $prefix . 'pages-layolt';
    $update_banned = $mysqli->query("UPDATE `$table` SET 
`text` = '$text' 
WHERE page='Banned'");
    
    $update_blocked = $mysqli->query("UPDATE `$table` SET 
`text` = '$text2' 
WHERE page='Blocked'");
    
    $update_massrequests = $mysqli->query("UPDATE `$table` SET 
`text` = '$text3' 
WHERE page='Mass_Requests'");
    
    $update_proxy = $mysqli->query("UPDATE `$table` SET 
`text` = '$text4' 
WHERE page='Proxy'");
    
    $update_spam = $mysqli->query("UPDATE `$table` SET 
`text` = '$text5' 
WHERE page='Spam'");
    
    $update_bannedc = $mysqli->query("UPDATE `$table` SET 
`text` = '$text6' 
WHERE page='Banned_Country'");
    
    $update_blockedbr = $mysqli->query("UPDATE `$table` SET 
`text` = '$text7' 
WHERE page='Blocked_Browser'");
    
    $update_blockedos = $mysqli->query("UPDATE `$table` SET 
`text` = '$text8' 
WHERE page='Blocked_OS'");
    
    $update_blockedisp = $mysqli->query("UPDATE `$table` SET 
`text` = '$text9' 
WHERE page='Blocked_ISP'");
    
    $update_blockedrfr = $mysqli->query("UPDATE `$table` SET 
`text` = '$text10' 
WHERE page='Blocked_RFR'");
    
    $update_badbot = $mysqli->query("UPDATE `$table` SET 
`text` = '$text11' 
WHERE page='Bad_Bot'");
    
    $update_fakebot = $mysqli->query("UPDATE `$table` SET 
`text` = '$text12' 
WHERE page='Fake_Bot'");
    
    $update_tor = $mysqli->query("UPDATE `$table` SET 
`text` = '$text13' 
WHERE page='Tor'");
    
    $update_adblocker = $mysqli->query("UPDATE `$table` SET 
`text` = '$text14' 
WHERE page='AdBLocker'");
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div class="content-header">
				
				<div class="container-fluid">
				  <div class="row mb-2">
        		    <div class="col-sm-6">
        		      <h1 class="m-0 text-dark"><i class="fas fa-file-text"></i> Warning Pages</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">Warning Pages</li>
        		      </ol>
        		    </div>
        		  </div>
    			</div>
            </div>

				<!--Page content-->
				<!--===================================================-->
				<div class="content">
				<div class="container-fluid">

                     <div class="card text-center">
						 <div class="card-header">
								<ul class="nav nav-tabs card-header-tabs">
									<li class="nav-item active">
										<a class="nav-link active" data-toggle="tab" href="#sqli-layout">SQL Injection</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#massrequests-layout">Mass Requests</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#proxy-layout">Proxy</a>
									</li>
                                    <li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#spam-layout">Spam</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#banned-layout">Banned</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#bannedc-layout">Banned Countries</a>
									</li>
                                    <li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#bannedbr-layout">Blocked Browsers</a>
									</li>
                                    <li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#bannedos-layout">Blocked OS</a>
									</li>
                                    <li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#bannedisp-layout">Blocked ISP</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#bannedrfr-layout">Blocked Referrer</a>
									</li>
                                    <li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#badbot-layout">Bad Bot</a>
									</li>
                                    <li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#fakebot-layout">Fake Bot</a>
									</li>
                                    <li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#tor-layout">Tor</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#adblocker-layout">AdBlocker</a>
									</li>
								</ul>
								</div>
					
								<!--Tabs Content-->
								<div class="card-body">
								<form action="" method="post">
								<div class="tab-content">
<?php
$table = $prefix . 'pages-layolt';
$sql   = $mysqli->query("SELECT * FROM `$table` WHERE page='Blocked'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="sqli-layout" class="tab-pane fade active show">
<fieldset>
	        <center>	  
            <label>Page Text:</label>
	        <textarea name="text2" class="form-control" rows="5" type="text" required><?php
echo html_entity_decode($row['text']);
?></textarea>
			</center>
</fieldset>
									</div>

<?php
$table = $prefix . 'pages-layolt';
$sql   = $mysqli->query("SELECT * FROM `$table` WHERE page='Mass_Requests'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="massrequests-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text3" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>

<?php
$table = $prefix . 'pages-layolt';
$sql   = $mysqli->query("SELECT * FROM `$table` WHERE page='Proxy'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="proxy-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text4" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
	        </center>
</fieldset>
									</div>
                                    
<?php
$table = $prefix . 'pages-layolt';
$sql   = $mysqli->query("SELECT * FROM `$table` WHERE page='Spam'");
$row   = mysqli_fetch_assoc($sql);
?>
                                    <div id="spam-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text5" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
	        </center>
</fieldset>
									</div>
                                    
<?php
$table = $prefix . 'pages-layolt';
$sql   = $mysqli->query("SELECT * FROM `$table` WHERE page='Banned'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="banned-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>
                                    
<?php
$table = $prefix . 'pages-layolt';
$sql   = $mysqli->query("SELECT * FROM `$table` WHERE page='Banned_Country'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="bannedc-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text6" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>
                                    
<?php
$table = $prefix . 'pages-layolt';
$sql   = $mysqli->query("SELECT * FROM `$table` WHERE page='Blocked_Browser'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="bannedbr-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text7" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>
                                    
<?php
$table = $prefix . 'pages-layolt';
$sql   = $mysqli->query("SELECT * FROM `$table` WHERE page='Blocked_OS'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="bannedos-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text8" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>
                                    
<?php
$table = $prefix . 'pages-layolt';
$sql   = $mysqli->query("SELECT * FROM `$table` WHERE page='Blocked_ISP'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="bannedisp-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text9" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>

<?php
$table = $prefix . 'pages-layolt';
$sql   = $mysqli->query("SELECT * FROM `$table` WHERE page='Blocked_RFR'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="bannedrfr-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text10" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>
									
<?php
$table = $prefix . 'pages-layolt';
$sql   = $mysqli->query("SELECT * FROM `$table` WHERE page='Bad_Bot'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="badbot-layout" class="tab-pane fade">
<fieldset>
	        <center>	  
            <label>Page Text:</label>
	        <textarea name="text11" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>
                                    
<?php
$table = $prefix . 'pages-layolt';
$sql   = $mysqli->query("SELECT * FROM `$table` WHERE page='Fake_Bot'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="fakebot-layout" class="tab-pane fade">
<fieldset>
	        <center>	  
            <label>Page Text:</label>
	        <textarea name="text12" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>
                                    
<?php
$table = $prefix . 'pages-layolt';
$sql   = $mysqli->query("SELECT * FROM `$table` WHERE page='Tor'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="tor-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text13" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>
									
<?php
$table = $prefix . 'pages-layolt';
$sql   = $mysqli->query("SELECT * FROM `$table` WHERE page='AdBlocker'");
$row   = mysqli_fetch_assoc($sql);
?>
									<div id="adblocker-layout" class="tab-pane fade">
<fieldset>
	        <center>
            <label>Page Text:</label>
	        <textarea name="text14" class="form-control" rows="5" type="text" required><?php
echo $row['text'];
?></textarea>
			</center>
</fieldset>
									</div>

								</div>
								</div>
								</div>
							</div>
    
<input type="submit" class="btn btn-flat btn-success btn-md btn-block" name="update" value="Save" />
<button type="reset" class="btn btn-flat btn-default btn-md btn-block">Reset</button>
</form>
                    
				</div>
				</div>
				<!--===================================================-->
				<!--End page content-->

			</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->
</div>
<?php
footer();
?>