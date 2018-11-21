<?php
require("core.php");
head();

$ch = curl_init('https://codecanyon.net/item/project-security-website-security-antivirus-firewall/15487703');
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
curl_setopt($ch, CURLOPT_REFERER, "https://google.com");
$data = curl_exec($ch);
curl_close($ch);

$DOM = new DOMDocument;
libxml_use_internal_errors(true);
$DOM->loadHTML($data);

$updatedate = $DOM->getElementsByTagName('time');

libxml_clear_errors();
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div class="content-header">

				<div class="container-fluid">
				  <div class="row mb-2">
        		    <div class="col-sm-6">
        		      <h1 class="m-0 text-dark"><i class="fas fa-sync"></i> Check for Updates</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">Check for Updates</li>
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

<?php
if (strtotime($predictdate) >= strtotime($updatedate->item(0)->nodeValue)) {
    echo '<div class="card card-solid card-success">';
} else {
    echo '<div class="card card-solid card-danger">';
}
?>
						<div class="card-header">
<?php
if (strtotime($predictdate) >= strtotime($updatedate->item(0)->nodeValue)) {
    echo '<h3 class="card-title"><i class="fas fa-check-circle"></i> Up To Date</h3>';
} else {
    echo '<h3 class="card-title"><i class="fas fa-exclamation-triangle"></i> Out Of Date</h3>';
}
?>
						</div>
						<div class="card-body jumbotron">
<center>
        <h1 style="color: #0088cc;"><i class="fab fa-get-pocket"></i> BeFree</h1>
<br />
  Build Date: <span class="badge badge-primary"><?php
echo $builddate;
?></span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  Latest Update: <span class="badge badge-success"><?php
echo $updatedate->item(0)->nodeValue;
?></span>
        <hr>
<?php
if (strtotime($predictdate) >= strtotime($updatedate->item(0)->nodeValue)) {
    echo '<p>You have the <strong>latest version</strong> of <strong>BeFree</strong> installed.</p>';
} else {
    echo '<p>You must update <strong>Project SECURITY</strong> to the <strong>latest version</strong>.</p><br />
<a href="https://codecanyon.net/item/project-security-website-security-antivirus-firewall/15487703?ref=Antonov_WEB" title="Download the Update" target="_blank" class="btn btn-flat btn-success btn-lg">
<i class="fas fa-download"></i> Download Update
</a>
';
}
?>
</center>
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
<?php
footer();
?>
