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
        		      <h1 class="m-0 text-dark"><i class="fas fa-list"></i> IP Blacklist Checker</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">IP Blacklist Checker</li>
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
							<h3 class="card-title">IP Blacklist Checker</h3>
						</div>
						<div class="card-body">
<form method="post" >
	IP Address:
	<input type="text" class="form-control" name="ip" placeholder="1.2.3.4" required/><br />
	<input type="submit" class="btn btn-primary btn-block btn-flat" value="Lookup" />
</form>
                        </div>
                    </div>
