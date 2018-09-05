<?php
require("core.php");
head();

if (isset($_POST['save'])) {
    $table = $prefix . 'content-protection';

    if (isset($_POST['rightclick-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    if (isset($_POST['rightclick-alert'])) {
        $alert = 1;
    } else {
        $alert = 0;
    }
    $message = $_POST['rightclick-message'];
    $update  = $mysqli->query("UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=1");

    if (isset($_POST['rightclick_images-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    if (isset($_POST['rightclick_images-alert'])) {
        $alert = 1;
    } else {
        $alert = 0;
    }
    $message = $_POST['rightclick_images-message'];
    $update  = $mysqli->query("UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=2");

    if (isset($_POST['cut-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    if (isset($_POST['cut-alert'])) {
        $alert = 1;
    } else {
        $alert = 0;
    }
    $message = $_POST['cut-message'];
    $update  = $mysqli->query("UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=3");

    if (isset($_POST['copy-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    if (isset($_POST['copy-alert'])) {
        $alert = 1;
    } else {
        $alert = 0;
    }
    $message = $_POST['copy-message'];
    $update  = $mysqli->query("UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=4");

    if (isset($_POST['paste-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    if (isset($_POST['paste-alert'])) {
        $alert = 1;
    } else {
        $alert = 0;
    }
    $message = $_POST['paste-message'];
    $update  = $mysqli->query("UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=5");

    if (isset($_POST['drag-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    $update = $mysqli->query("UPDATE `$table` SET enabled='$enabled' WHERE id=6");

    if (isset($_POST['drop-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    $update = $mysqli->query("UPDATE `$table` SET enabled='$enabled' WHERE id=7");

    if (isset($_POST['printscreen-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    if (isset($_POST['printscreen-alert'])) {
        $alert = 1;
    } else {
        $alert = 0;
    }
    $message = $_POST['printscreen-message'];
    $update  = $mysqli->query("UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=8");

    if (isset($_POST['print-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    if (isset($_POST['print-alert'])) {
        $alert = 1;
    } else {
        $alert = 0;
    }
    $message = $_POST['print-message'];
    $update  = $mysqli->query("UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=9");

    if (isset($_POST['view_source-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    if (isset($_POST['view_source-alert'])) {
        $alert = 1;
    } else {
        $alert = 0;
    }
    $message = $_POST['view_source-message'];
    $update  = $mysqli->query("UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=10");

    if (isset($_POST['iframe_out-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    $update = $mysqli->query("UPDATE `$table` SET enabled='$enabled' WHERE id=11");

    if (isset($_POST['selecting-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    $update = $mysqli->query("UPDATE `$table` SET enabled='$enabled' WHERE id=12");

	if (isset($_POST['jquery_include'])) {
        $jquery_include = 1;
    } else {
        $jquery_include = 0;
    }

	$table2 = $prefix . 'settings';
    $query2 = $mysqli->query("UPDATE `$table2` SET jquery_include='$jquery_include' WHERE id=1");
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div class="content-header">

				<div class="container-fluid">
				  <div class="row mb-2">
        		    <div class="col-sm-6">
        		      <h1 class="m-0 text-dark"><i class="fas fa-file-text"></i> Content Protection</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">Content Protection</li>
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

				<form action="" method="post" class="form-horizontal form-bordered">
<?php
$table = $prefix . 'settings';
$query = $mysqli->query("SELECT * FROM `$table`");
$row   = mysqli_fetch_array($query);
?>

<div class="card card-body bg-light">
<div class="form-group row">
												<div class="col-md-2">
												<label class="control-label">jQuery Include</label><br />


														      <input type="checkbox" name="jquery_include" class="psec-switch" <?php
if ($row['jquery_include'] == 1) {
    echo 'checked';
}
?> />
												</div>
												<div class="col-md-10">
												    | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Enable</strong> this option if your website does not have a jquery file included
												    <br />|
												</div>
												</div>
											</div>

								<button type="button submit" name="save" class="mb-xs mt-xs mr-xs btn btn-flat btn-success btn-lg btn-block"><i class="fas fa-floppy"></i>&nbsp;&nbsp;Save</button><br />
                <?php
                $i     = 0;
                $table = $prefix . 'content-protection';
                $query = $mysqli->query("SELECT * FROM `$table`");
                while ($row = $query->fetch_assoc()) {
                    ++$i;
                    if ($i == 1) {
                        echo '<div class="row">';
                    }
                ?>
                								<div class="col-md-4">
                								    <div class="card card-solid card-primary">
                								         <div class="card-header">
                                                              <h3 class="card-title">
                <?php
                    if ($row['function'] == "rightclick") {
                        echo '<i class="fas fa-mouse-pointer"></i> Right Click - Context Menu';
                    } elseif ($row['function'] == "rightclick_images") {
                        echo '<i class="fas fa-hand-pointer"></i> Right Click - Context Menu on Images';
                    } elseif ($row['function'] == "cut") {
                        echo '<i class="fas fa-cut"></i> Cut';
                    } elseif ($row['function'] == "copy") {
                        echo '<i class="fas fa-copy"></i> Copy';
                    } elseif ($row['function'] == "paste") {
                        echo '<i class="fas fa-clipboard"></i> Paste';
                    } elseif ($row['function'] == "drag") {
                        echo '<i class="fas fa-arrows-alt"></i> Drag';
                    } elseif ($row['function'] == "drop") {
                        echo '<i class="fas fa-plus-square"></i> Drop';
                    } elseif ($row['function'] == "printscreen") {
                        echo '<i class="fas fa-desktop"></i> PrintScreen Button';
                    } elseif ($row['function'] == "print") {
                        echo '<i class="fas fa-print"></i> Print';
                    } elseif ($row['function'] == "view_source") {
                        echo '<i class="fas fa-code"></i> View Source Keyboard Shortcut';
                    } elseif ($row['function'] == "iframe_out") {
                        echo '<i class="fas fa-object-group"></i> Website shows in Frames (Iframe)';
                    } elseif ($row['function'] == "selecting") {
                        echo '<i class="fas fa-arrows-alt-h"></i> Selecting';
                    }
                ?>
                                                       </h3>
                                                    </div>
                									<div class="card-body">
                										<p class="text-center">
                <?php
                    if ($row['function'] == "rightclick") {
                        echo 'Prevent the Right Menu (Context Menu) from popping up';
                    } elseif ($row['function'] == "rightclick_images") {
                        echo 'Prevent downloading of website\'s images';
                    } elseif ($row['function'] == "cut") {
                        echo 'Prevent Cutting content from your website';
                    } elseif ($row['function'] == "copy") {
                        echo 'Prevent Copying content from your website';
                    } elseif ($row['function'] == "paste") {
                        echo 'Prevent Pasting content on your website';
                    } elseif ($row['function'] == "drag") {
                        echo 'Prevent Dragging content and objects on your website';
                    } elseif ($row['function'] == "drop") {
                        echo 'Prevent Dropping content and objects on your website';
                    } elseif ($row['function'] == "printscreen") {
                        echo 'Prevent taking screenshots of the website';
                    } elseif ($row['function'] == "print") {
                        echo 'Prevent printing of the pages of your website';
                    } elseif ($row['function'] == "view_source") {
                        echo 'Prevent the View Source Code Keyboard Shortcut (CTRL+U)';
                    } elseif ($row['function'] == "iframe_out") {
                        echo 'You can enable this option to ensure that your page never gets loaded into iFrames';
                    } elseif ($row['function'] == "selecting") {
                        echo 'Prevent content selecting on your website';
                    }
                ?>
                										</p>
                									    <hr>
                										<div class="form-group">
                												<label class="control-label">Activated</label>
                												<div class="col-md-12">

                														<input type="checkbox" name="<?php
                    echo $row['function'];
                ?>-enabled" class="psec-switch" <?php
                    if ($row['enabled'] == 1) {
                        echo 'checked="checked"';
                    }
                ?>/>
                												    </div>
                										</div>
                										<div class="form-group">
                												<label class="control-label">Alert</label>
                												<div class="col-md-12">

                														<input type="checkbox" name="<?php
                    echo $row['function'];
                ?>-alert" class="psec-switch" <?php
                    if ($row['alert'] == 1) {
                        echo 'checked="checked"';
                    }
                ?>
                <?php
                    if ($row['function'] == 'drag' OR $row['function'] == 'drop' OR $row['function'] == 'iframe_out' OR $row['function'] == 'selecting') {
                        echo 'disabled="disabled"';
                    }
                ?>/>
                												    </div>
                									    </div>
                										<div class="form-group">
                												<label class="control-label">Alert Message</label>
                													<div class="col-md-12">
                													<input type="text" name="<?php
                    echo $row['function'];
                ?>-message" value="<?php
                    echo $row['message'];
                ?>" class="form-control input-rounded" id="inputRounded"
                													<?php
                    if ($row['function'] == 'drag' OR $row['function'] == 'drop' OR $row['function'] == 'iframe_out' OR $row['function'] == 'selecting') {
                        echo 'disabled';
                    }
                ?>>
                												</div>
                									    </div>
                									</div>
                								</div>
                							    </div>
                <?php
                    if ($i == 12) {
                        echo '</div>';
                    } else if (($i % 3) == 0) {
                        echo '</div><div class="row">';
                    }
                }
                ?>

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
