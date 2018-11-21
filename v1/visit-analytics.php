<?php
require("core.php");
head();

@$date = @date('d F Y');
@$ctime = @date("H:i", strtotime('-30 seconds'));

$table    = $prefix . 'live-traffic';
$tsquery1 = $mysqli->query("SELECT id FROM `$table` WHERE `date`='$date' AND `time`>='$ctime'");
$tscount1 = $tsquery1->num_rows;
$tsquery2 = $mysqli->query("SELECT id FROM `$table` WHERE `date`='$date' AND `uniquev`=1");
$tscount2 = $tsquery2->num_rows;
$tsquery3 = $mysqli->query("SELECT id FROM `$table` WHERE `date`='$date'");
$tscount3 = $tsquery3->num_rows;
$tsquery4 = $mysqli->query("SELECT id FROM `$table` WHERE `date`='$date' AND `uniquev`=1 AND `bot`=1");
$tscount4 = $tsquery4->num_rows;

//Today Stats
@$mdate = @date('F Y');
$msquery1 = $mysqli->query("SELECT id FROM `$table` WHERE `date` LIKE '%$mdate' AND `uniquev`=1");
$mscount1 = $msquery1->num_rows;
$msquery2 = $mysqli->query("SELECT id FROM `$table` WHERE `date` LIKE '%$mdate'");
$mscount2 = $msquery2->num_rows;
$msquery3 = $mysqli->query("SELECT id FROM `$table` WHERE `date` LIKE '%$mdate' AND `uniquev`=1 AND `bot`=1");
$mscount3 = $msquery3->num_rows;

//Browser Stats
$bquery1 = $mysqli->query("SELECT id FROM `$table` WHERE `browser` = 'Google Chrome'");
$bcount1 = $bquery1->num_rows;
$bquery2 = $mysqli->query("SELECT id FROM `$table` WHERE `browser` LIKE '%Firefox%'");
$bcount2 = $bquery2->num_rows;
$bquery3 = $mysqli->query("SELECT id FROM `$table` WHERE `browser` = 'Opera'");
$bcount3 = $bquery3->num_rows;
$bquery4 = $mysqli->query("SELECT id FROM `$table` WHERE `browser` LIKE '%Edge%'");
$bcount4 = $bquery4->num_rows;
$bquery5 = $mysqli->query("SELECT id FROM `$table` WHERE `browser` = 'Internet Explorer'");
$bcount5 = $bquery5->num_rows;
$bquery6 = $mysqli->query("SELECT id FROM `$table` WHERE `browser` LIKE '%Safari%'");
$bcount6 = $bquery6->num_rows;
$bquery7 = $mysqli->query("SELECT id FROM `$table` WHERE `browser` != 'Google Chrome' AND `browser` NOT LIKE '%Firefox%' AND `browser` != 'Opera' AND `browser` NOT LIKE '%Edge%' AND `browser` != 'Internet Explorer' AND `browser` NOT LIKE '%Safari%'");
$bcount7 = $bquery7->num_rows;

//OS Stats
$oquery1 = $mysqli->query("SELECT id FROM `$table` WHERE `os` LIKE '%Windows%'");
$ocount1 = $oquery1->num_rows;
$oquery2 = $mysqli->query("SELECT id FROM `$table` WHERE `os` LIKE '%Linux%'");
$ocount2 = $oquery2->num_rows;
$oquery3 = $mysqli->query("SELECT id FROM `$table` WHERE `os` LIKE '%Android%'");
$ocount3 = $oquery3->num_rows;
$oquery4 = $mysqli->query("SELECT id FROM `$table` WHERE `os` LIKE '%iOS%'");
$ocount4 = $oquery4->num_rows;
$oquery5 = $mysqli->query("SELECT id FROM `$table` WHERE `os` LIKE '%Mac OS X%'");
$ocount5 = $oquery5->num_rows;
$oquery6 = $mysqli->query("SELECT id FROM `$table` WHERE `os` NOT LIKE '%Windows%' AND  `os` NOT LIKE '%Linux%' AND `os` NOT LIKE '%Android%' AND `os` NOT LIKE '%iOS%' AND `os` NOT LIKE '%Mac OS X%'");
$ocount6 = $oquery6->num_rows;

//Platform Stats
$pquery1 = $mysqli->query("SELECT id FROM `$table` WHERE `device_type` = 'Computer'");
$pcount1 = $pquery1->num_rows;
$pquery2 = $mysqli->query("SELECT id FROM `$table` WHERE `device_type` = 'Mobile'");
$pcount2 = $pquery2->num_rows;
$pquery3 = $mysqli->query("SELECT id FROM `$table` WHERE `device_type` = 'Tablet'");
$pcount3 = $pquery3->num_rows;
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div class="content-header">
				
				<div class="container-fluid">
				  <div class="row mb-2">
        		    <div class="col-sm-6">
        		      <h1 class="m-0 text-dark"><i class="fas fa-chart-line"></i> Visit Analytics</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">Visit Analytics</li>
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
							<h3 class="card-title">Visit Analytics</h3>
						</div>
						<div class="card-body">
<?php
if ($row['live_traffic'] == 0) {
?>
						<div class="alert alert-info" role="alert">
						  Please note that Visit Analytics will work only when Live Traffic is enabled
						</div>
<?php
}
?>
						
                             <h4 class="card-title">Today's Stats</h4><br />
							 
							 <div class="row">
                
					    <div class="col-sm-6 col-lg-3">
                            <div class="small-box bg-success">
                               <div class="inner">
                                   <h3><?php
echo $tscount1;
?></h3>
                                   <p>Online Visitors</p>
                               </div>
                               <div class="icon">
                                   <i class="fas fa-users"></i>
                               </div>
                            </div>
					    </div>
					    <div class="col-sm-6 col-lg-3">
					        <div class="small-box bg-info">
                               <div class="inner">
                                   <h3><?php
echo $tscount2;
?></h3>
                                   <p>Unique Visits</p>
                               </div>
                               <div class="icon">
                                   <i class="fas fa-chart-line"></i>
                               </div>
                            </div>
					    </div>
					    <div class="col-sm-6 col-lg-3">
					        <div class="small-box bg-danger">
                               <div class="inner">
                                   <h3><?php
echo $tscount3;
?></h3>
                                   <p>Total Visits</p>
                               </div>
                               <div class="icon">
                                   <i class="fas fa-chart-bar"></i>
                               </div>
                            </div>
					    </div>
					    <div class="col-sm-6 col-lg-3">
					        <div class="small-box bg-warning">
                               <div class="inner">
                                   <h3><?php
echo $tscount4;
?></h3>
                                   <p>Bot Visits</p>
                               </div>
                               <div class="icon">
                                   <i class="fab fa-android"></i>
                               </div>
                            </div>
					    </div>
					</div>
					
					    <br /><h4 class="card-title">This Month's Stats</h4><br />
					
					    <div class="row">
                
					    <div class="col-sm-6 col-lg-4">
					        <div class="small-box bg-info">
                               <div class="inner">
                                   <h3><?php
echo $mscount1;
?></h3>
                                   <p>Unique Visits</p>
                               </div>
                               <div class="icon">
                                   <i class="fas fa-chart-line"></i>
                               </div>
                            </div>
					    </div>
					    <div class="col-sm-6 col-lg-4">
					        <div class="small-box bg-danger">
                               <div class="inner">
                                   <h3><?php
echo $mscount2;
?></h3>
                                   <p>Total Visits</p>
                               </div>
                               <div class="icon">
                                   <i class="fas fa-chart-bar"></i>
                               </div>
                            </div>
					    </div>
					    <div class="col-sm-6 col-lg-4">
					        <div class="small-box bg-warning">
                               <div class="inner">
                                   <h3><?php
echo $mscount3;
?></h3>
                                   <p>Bot Visits</p>
                               </div>
                               <div class="icon">
                                   <i class="fab fa-android"></i>
                               </div>
                            </div>
					    </div>
					</div>
					
					<br /><h4 class="card-title">Visits This Month</h4><br />
					
						<canvas id="visits-chart"></canvas>
						
					<br /><h4 class="card-title">Overall Statistics</h4><br />	
						
						<div class="row">
						     <div class="col-md-6">
							      <center><h5>Browser Statistics</h5></center>
								  <div id="canvas-holder" style="width:100%">
								  	  <canvas id="browser-graph"></canvas>
								  </div>
							 </div>
							 
							 <div class="col-md-6">
							      <center><h5>Operating System Statistics</h5></center>
							      <div id="canvas-holder" style="width:100%">
								  	  <canvas id="os-graph"></canvas>
								  </div>
							 </div>
					  </div>
					  <div class="row">
							 <div class="col-md-6">
							      <br /><center><h5>Device Statistics</h5></center>
							      <div id="canvas-holder" style="width:100%">
								  	  <canvas id="device-graph"></canvas>
								  </div>
							 </div>
						</div>
						
						<div class="col-md-12">
						<hr />
						    <center><h5>Visits by Country</h5></center>
							
<table id="dt-basic" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
								          <th><i class="fas fa-globe"></i> Country</th>
						                  <th><i class="fas fa-users"></i> Visitors</th>
										</tr>
									</thead>
									<tbody>
<?php
$countries = array(
    "Afghanistan",
    "Albania",
    "Algeria",
    "Andorra",
    "Angola",
    "Antigua and Barbuda",
    "Argentina",
    "Armenia",
    "Australia",
    "Austria",
    "Azerbaijan",
    "Bahamas",
    "Bahrain",
    "Bangladesh",
    "Barbados",
    "Belarus",
    "Belgium",
    "Belize",
    "Benin",
    "Bhutan",
    "Bolivia",
    "Bosnia and Herzegovina",
    "Botswana",
    "Brazil",
    "Brunei",
    "Bulgaria",
    "Burkina Faso",
    "Burundi",
    "Cambodia",
    "Cameroon",
    "Canada",
    "Cape Verde",
    "Central African Republic",
    "Chad",
    "Chile",
    "China",
    "Colombi",
    "Comoros",
    "Congo (Brazzaville)",
    "Congo",
    "Costa Rica",
    "Cote d\'Ivoire",
    "Croatia",
    "Cuba",
    "Cyprus",
    "Czech Republic",
    "Denmark",
    "Djibouti",
    "Dominica",
    "Dominican Republic",
    "East Timor (Timor Timur)",
    "Ecuador",
    "Egypt",
    "El Salvador",
    "Equatorial Guinea",
    "Eritrea",
    "Estonia",
    "Ethiopia",
    "Fiji",
    "Finland",
    "France",
    "Gabon",
    "Gambia, The",
    "Georgia",
    "Germany",
    "Ghana",
    "Greece",
    "Grenada",
    "Guatemala",
    "Guinea",
    "Guinea-Bissau",
    "Guyana",
    "Haiti",
    "Honduras",
    "Hungary",
    "Iceland",
    "India",
    "Indonesia",
    "Iran",
    "Iraq",
    "Ireland",
    "Israel",
    "Italy",
    "Jamaica",
    "Japan",
    "Jordan",
    "Kazakhstan",
    "Kenya",
    "Kiribati",
    "Korea, North",
    "Korea, South",
    "Kuwait",
    "Kyrgyzstan",
    "Laos",
    "Latvia",
    "Lebanon",
    "Lesotho",
    "Liberia",
    "Libya",
    "Liechtenstein",
    "Lithuania",
    "Luxembourg",
    "Macedonia",
    "Madagascar",
    "Malawi",
    "Malaysia",
    "Maldives",
    "Mali",
    "Malta",
    "Marshall Islands",
    "Mauritania",
    "Mauritius",
    "Mexico",
    "Micronesia",
    "Moldova",
    "Monaco",
    "Mongolia",
    "Morocco",
    "Mozambique",
    "Myanmar",
    "Namibia",
    "Nauru",
    "Nepal",
    "Netherlands",
    "New Zealand",
    "Nicaragua",
    "Niger",
    "Nigeria",
    "Norway",
    "Oman",
    "Pakistan",
    "Palau",
    "Panama",
    "Papua New Guinea",
    "Paraguay",
    "Peru",
    "Philippines",
    "Poland",
    "Portugal",
    "Qatar",
    "Romania",
    "Russia",
    "Rwanda",
    "Saint Kitts and Nevis",
    "Saint Lucia",
    "Saint Vincent",
    "Samoa",
    "San Marino",
    "Sao Tome and Principe",
    "Saudi Arabia",
    "Senegal",
    "Serbia and Montenegro",
    "Seychelles",
    "Sierra Leone",
    "Singapore",
    "Slovakia",
    "Slovenia",
    "Solomon Islands",
    "Somalia",
    "South Africa",
    "Spain",
    "Sri Lanka",
    "Sudan",
    "Suriname",
    "Swaziland",
    "Sweden",
    "Switzerland",
    "Syria",
    "Taiwan",
    "Tajikistan",
    "Tanzania",
    "Thailand",
    "Togo",
    "Tonga",
    "Trinidad and Tobago",
    "Tunisia",
    "Turkey",
    "Turkmenistan",
    "Tuvalu",
    "Uganda",
    "Ukraine",
    "United Arab Emirates",
    "United Kingdom",
    "United States",
    "Uruguay",
    "Uzbekistan",
    "Vanuatu",
    "Vatican City",
    "Venezuela",
    "Vietnam",
    "Yemen",
    "Zambia",
    "Zimbabwe"
);

foreach ($countries as $country) {
    $log_result = $mysqli->query("SELECT country_code FROM `$table` WHERE `country` LIKE '%$country%'");
    $log_rows   = mysqli_num_rows($log_result);
    $lgrow      = mysqli_fetch_assoc($log_result);
    
    if ($log_rows > 0) {
        echo '<tr>';
        echo '<td><img src="assets/plugins/flags/blank.png" class="flag flag-' . strtolower($lgrow['country_code']) . '"/>&nbsp; ' . $country . '</td>';
        echo '<td>' . $log_rows . '</td>';
        echo '</tr>';
    }
}
?>
</tbody>
</table>

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
var config = {
    type: 'pie',
    data: {
		datasets: [{
			data: [
				<?php
echo $bcount1;
?>,
				<?php
echo $bcount2;
?>,
				<?php
echo $bcount3;
?>,
				<?php
echo $bcount4;
?>,
				<?php
echo $bcount5;
?>,
				<?php
echo $bcount6;
?>,
				<?php
echo $bcount7;
?>,
					],
					backgroundColor: [
						'#00FF00',
    					'#FFD700',
    					'#FF0000',
						'#00BFFF',
						'#1E90FF',
						'#B0C4DE',
    					'#000000',
					]
				}],
				labels: [
					'Google Chrome',
					'Firefox',
					'Opera',
					'Edge',
					'Internet Explorer',
					'Safari',
					'Other'
				]
			},
			options: {
				responsive: true
			}
  };
  
var config2 = {
    type: 'pie',
    data: {
		datasets: [{
			data: [
				<?php
echo $ocount1;
?>,
				<?php
echo $ocount2;
?>,
				<?php
echo $ocount3;
?>,
				<?php
echo $ocount4;
?>,
				<?php
echo $ocount5;
?>,
				<?php
echo $ocount6;
?>,
					],
					backgroundColor: [
						'#1E90FF',
    					'#FFD700',
    					'#7CFC00',
						'#D3D3D3',
						'#B0C4DE',
    					'#000000',
					]
				}],
				labels: [
					'Windows',
					'Linux',
					'Android',
					'iOS',
					'Mac OS X',
					'Other'
				]
			},
			options: {
				responsive: true
			}
  };
  
var config3 = {
    type: 'pie',
    data: {
		datasets: [{
			data: [
				<?php
echo $pcount2;
?>,
				<?php
echo $pcount3;
?>,
				<?php
echo $pcount1;
?>,
					],
					backgroundColor: [
						'#00BFFF',
    					'#FFD700',
    					'#FF0000',
					]
				}],
				labels: [
					'Mobile',
					'Tablet',
					'Computer'
				]
			},
			options: {
				responsive: true
			}
  };
  
		var config4 = {
			type: 'line',
			data: {
				labels: [
<?php
$i    = 1;
$days = cal_days_in_month(CAL_GREGORIAN, date("n"), date("Y"));
while ($i <= $days) {
    echo "'$i'";
    
    if ($i != $days) {
        echo ',';
    }
    
    $i++;
}
?>
				],
				datasets: [{
					label: 'Total Visits',
					backgroundColor: '#1E90FF',
					borderColor: '#1E90FF',
					data: [
<?php
$i    = 1;
$days = cal_days_in_month(CAL_GREGORIAN, date("n"), date("Y"));
while ($i <= $days) {
    @$mdatef = sprintf("%02d", $i) . ' ' . date("F Y");
    $mquery1 = $mysqli->query("SELECT id FROM `$table` WHERE `date` = '$mdatef'");
    $mcount1 = $mquery1->num_rows;
    echo "'$mcount1'";
    
    if ($i != $days) {
        echo ',';
    }
    
    $i++;
}
?>
					],
					fill: false,
				}, {
					label: 'Unique Visits',
					fill: false,
					backgroundColor: '#3CB371',
					borderColor: '#3CB371',
					data: [
<?php
$i    = 1;
$days = cal_days_in_month(CAL_GREGORIAN, date("n"), date("Y"));
while ($i <= $days) {
    @$mdatef = sprintf("%02d", $i) . ' ' . date("F Y");
    $mquery2 = $mysqli->query("SELECT id FROM `$table` WHERE `date` = '$mdatef' AND `uniquev`=1");
    $mcount2 = $mquery2->num_rows;
    echo "'$mcount2'";
    
    if ($i != $days) {
        echo ',';
    }
    
    $i++;
}
?>
					],
				}]
			},
			options: {
				responsive: true,
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: '<?php
echo date("F Y");
?> '
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Visits'
						}
					}]
				}
			}
		};
  
  window.onload = function() {
	var ctx = document.getElementById('browser-graph').getContext('2d');
	window.browsergraph = new Chart(ctx, config);
	var ctx2 = document.getElementById('os-graph').getContext('2d');
	window.osgraph = new Chart(ctx2, config2);
	var ctx3 = document.getElementById('device-graph').getContext('2d');
	window.devicegraph = new Chart(ctx3, config3);
	var ctx4 = document.getElementById('visits-chart').getContext('2d');
	window.visitschart = new Chart(ctx4, config4);
  };
  
$(document).ready(function() {

	$('#dt-basic').dataTable( {
		"responsive": true,
        "order": [[ 1, "desc" ]],
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