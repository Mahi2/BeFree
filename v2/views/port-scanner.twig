<?php
require("core.php");
head();
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div class="content-header">
				
				<div class="container-fluid">
				  <div class="row mb-2">
        		    <div class="col-sm-6">
        		      <h1 class="m-0 text-dark"><i class="fas fa-search"></i> Port Scanner</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">Port Scanner</li>
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
							<h3 class="card-title">Port Scanner</h3>
						</div>
						<div class="card-body">
<form method="post" >
	IP / Domain: 
	<input type="text" class="form-control" name="ipdomain" placeholder="example.com" required/><br /> 
	<input type="submit" class="btn btn-primary btn-block btn-flat" value="Scan" />
</form>
                        </div>
                    </div>
					 
<?php
if (!empty($_POST['ipdomain'])) {
    $ports = array(
        20,
        21,
        22,
        23,
        25,
        53,
        80,
        110,
        119,
        135,
        137,
        138,
        139,
        143,
        443,
        520,
        1433,
        1434,
        1723,
        2082,
        2086,
        2095,
        3306,
        8080
    );
    
    $results = array();
    foreach ($ports as $port) {
        if ($pf = @fsockopen($_POST['ipdomain'], $port, $err, $err_string, 1)) {
            $results[$port] = true;
            fclose($pf);
        } else {
            $results[$port] = false;
        }
    }
    
    echo '<div class="card">
			<div class="card-header">
				<h3 class="card-title">Scan results for <b>' . $_POST['ipdomain'] . '</b></h3>
			</div>
			<div class="card-body">';
    
    echo '<div class="table-responsive"><table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th><i class="fas fa-dot"></i> Port</th>
        <th><i class="fas fa-cogs"></i> Service</th>
        <th><i class="fas fa-info-circle"></i> Status</th>
      </tr>
    </thead>
    <tbody>';
    
    foreach ($results as $port => $val) {
        $prot = getservbyport($port, "tcp");
        echo "<tr><td>$port</td><td>$prot</td>";
        if ($val) {
            echo '<td><a href="http://' . $_POST['ipdomain'] . ':' . $port . '" target="_blank" class="badge badge-danger" style="font-size: 13px;"><i class="fas fa-unlock"></i> Open</a></td></tr>';
        } else {
            echo '
			<td><font class="badge badge-success" style="font-size: 13px;"><i class="fas fa-lock"></i> Closed</font></td></tr>';
        }
    }
    
    echo '</tbody>
    </table></div>';
    
    echo '</div></div></div>';
} else {
    echo '</div>';
}
?>
                    
				<div class="col-md-3">
				     <div class="card">
						<div class="card-header">
							<h3 class="card-title">What is Port Scanning</h3>
						</div>
				        <div class="card-body">
						    Port Scanning is the name for the technique used to identify open ports and services available on a network host. Port Scanning is used to determine which ports are open and vulnerable to attacks. 
							<br /><br />
							Port Scanning is a slow proccess and can take a while.
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