<?php
require("core.php");
head();

if (isset($_POST['ersave'])) {
    $table = $prefix . "settings";

    $ereporting = $_POST['erselect'];
    $derrors    = $_POST['deselect'];

    $esupdate = $mysqli->query("UPDATE `$table` SET error_reporting='$ereporting', display_errors='$derrors'");
}
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div class="content-header">

				<div class="container-fluid">
				  <div class="row mb-2">
        		    <div class="col-sm-6">
        		      <h1 class="m-0 text-dark"><i class="fas fa-exclamation-circle"></i> Error Monitoring</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">Error Monitoring</li>
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
				<div class="col-md-9">
				        <div class="card">
						<div class="card-header">
							<h3 class="card-title">Settings</h3>
						</div>
						<div class="card-body">
<?php
$table  = $prefix . 'settings';
$result = $mysqli->query("SELECT * FROM `$table`");
$row    = mysqli_fetch_assoc($result);
?>
                            <form method="post">
							    <label><i class="fas fa-bug"></i> Error Reporting</label>
                                <select class="form-control" name="erselect" style="width: 100%;">
                                    <option value="1" <?php
if ($row['error_reporting'] == 1)
    echo 'selected="selected" ';
?>>Turned Off</option>
                                    <option value="2" <?php
if ($row['error_reporting'] == 2)
    echo 'selected="selected" ';
?>>Report simple running errors</option>
                                    <option value="3" <?php
if ($row['error_reporting'] == 3)
    echo 'selected="selected" ';
?>>Report simple running errors + notices</option>
                                    <option value="4" <?php
if ($row['error_reporting'] == 4)
    echo 'selected="selected" ';
?>>Report all errors except notices</option>
                                    <option value="5" <?php
if ($row['error_reporting'] == 5)
    echo 'selected="selected" ';
?>>Report all PHP errors</option>
                                </select>
		                        <br />
								<label><i class="fas fa-eye"></i> Errors Visibility</label>
								<select class="form-control" name="deselect" style="width: 100%;">
                                    <option value="0" <?php
if ($row['display_errors'] == 0)
    echo 'selected="selected" ';
?>>Hide Errors</option>
									<option value="1" <?php
if ($row['display_errors'] == 1)
    echo 'selected="selected" ';
?>>Display Errors</option>
                                </select>
		                        <br />
		                        <input class="btn btn-primary btn-block btn-flat" type="submit" name="ersave" value="Save" />
		                    </form>
						</div>
						</div>

				        <div class="card">
						<div class="card-header">
							<h3 class="card-title">Error Monitoring</h3>
						</div>
						<div class="card-body">
<?php
$log_errors = ini_get('log_errors');

if (!$log_errors)
    echo '<p>Error Logging is disabled on your server</p>';

$error_log = ini_get('error_log');
$logs      = array(
    $error_log
);
$count     = 10000;
$lines     = array();

foreach ($logs as $log) {
    if (is_readable($log))
        $lines = array_merge($lines, last_lines($log, $count));
}

$lines = array_map('trim', $lines);
$lines = array_filter($lines);

if (empty($lines)) {
    //echo '<p>No errors found...</p>';
}

foreach ($lines as $key => $line) {
    if (false != strpos($line, ']'))
        list($time, $error) = explode(']', $line, 2);
    else
        list($time, $error) = array(
            '',
            $line
        );

    $time        = trim($time, '[]');
    $error       = trim($error);
    $lines[$key] = compact('time', 'error');
}

if (@count($error_log) > 1) {
    uasort($lines, array(
        'time_field_compare'
    ));
    $lines = array_slice($lines, 0, $count);
}
?>
        <table id="dt-basic" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
			<tr>
				<th><i class="fas fa-calendar"></i> Date & Time</th>
				<th><i class="fas fa-exclamation-circle"></i> Error</th>
			</tr>
		</thead>
        <tbody>
        <?php
foreach ($lines as $line) {
    $error = $line['error'];
    $time  = $line['time'];

    if (!empty($error))
        echo ("<tr><td>{$time}</td><td>{$error}</td></tr>");
}
?>
            </tbody>
        </table>
        <?php

// Compare callback for freeform date/time strings.
function time_field_compare($a, $b)
{
    if ($a == $b)
        return 0;
    return (strtotime($a['time']) > strtotime($b['time'])) ? -1 : 1;
}

// Reads lines from end of file. Memory-safe.
function last_lines($path, $line_count, $block_size = 512)
{
    $lines = array();

    // we will always have a fragment of a non-complete line
    // keep this in here till we have our next entire line.
    $leftover = '';

    $fh = fopen($path, 'r');
    // go to the end of the file
    fseek($fh, 0, SEEK_END);

    do {
        // need to know whether we can actually go back
        // $block_size bytes
        $can_read = $block_size;

        if (ftell($fh) <= $block_size)
            $can_read = ftell($fh);

        if (empty($can_read))
            break;

        // go back as many bytes as we can
        // read them to $data and then move the file pointer
        // back to where we were.
        fseek($fh, -$can_read, SEEK_CUR);
        $data = fread($fh, $can_read);
        $data .= $leftover;
        fseek($fh, -$can_read, SEEK_CUR);

        // split lines by \n. Then reverse them,
        // now the last line is most likely not a complete
        // line which is why we do not directly add it, but
        // append it to the data read the next time.
        $split_data = array_reverse(explode("\n", $data));
        $new_lines  = array_slice($split_data, 0, -1);
        $lines      = array_merge($lines, $new_lines);
        $leftover   = $split_data[count($split_data) - 1];
    } while (count($lines) < $line_count && ftell($fh) != 0);

    if (ftell($fh) == 0)
        $lines[] = $leftover;

    fclose($fh);
    // Usually, we will read too many lines, correct that here.
    return array_slice($lines, 0, $line_count);
}

?>
                              </div>
						   </div>
                        </div>
						<div class="col-md-3">
							<div class="card">
						<div class="card-header">
							<h3 class="card-title">Information & Tips</h3>
						</div>
						<div class="card-body">
									Logging errors is recommended best practice, even for production site. Checking those logs however might seem like a chore. The error monitoring brings all entries from error log on this page.<br /><br />
                                    <ul>
                                    <li>The log file is detected automatically from the configuration of the server</li>
                                    <li>Only the end of file is read - no memory overflow issues, safe for large logs</li>
                                    <li>Optimized to work card card-body bg-light even with very large log files</li>
                                    </ul>
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
