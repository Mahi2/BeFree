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
        		      <h1 class="m-0 text-dark"><i class="fas fa-lock"></i> Hashing</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">Hashing</li>
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
							<h3 class="card-title">Hash Encoder</h3>
						</div>
						<div class="card-body">
<?php
@$_SESSION['string-input'] = $_POST['string'];
?>
                                    <form action="" method="post">
											<div class="form-group">
												<label>Text / String:</label>
													<textarea class="form-control" rows="3" name="string" required><?php
echo $_SESSION['string-input'];
?></textarea>
											</div>
                                        <button type="submit" name="generate" class="btn btn-flat btn-primary"><i class="fas fa-refresh"></i> Generate Hash</button>
								    </form>

                                    <br /><br />

                            <div class="tabs">
				                 <ul class="nav nav-tabs">
									<li class="nav-item active">
										<a href="#md5" class="nav-link active" data-toggle="tab">MD5</a>
									</li>
                                    <li class="nav-item">
										<a href="#base64" class="nav-link" data-toggle="tab">Base64</a>
									</li>
									<li class="nav-item">
										<a href="#sha-1" class="nav-link" data-toggle="tab">SHA-1</a>
									</li>
                                    <li class="nav-item">
										<a href="#sha-256" class="nav-link" data-toggle="tab">SHA-256</a>
									</li>
                                    <li class="nav-item">
										<a href="#sha-512" class="nav-link" data-toggle="tab">SHA-512</a>
									</li>
                                    <li class="nav-item">
										<a href="#whirlpool" class="nav-link" data-toggle="tab">Whirlpool</a>
									</li>
                                    <li class="nav-item">
										<a href="#crypt" class="nav-link" data-toggle="tab">Crypt</a>
									</li>
                                    <li class="nav-item">
										<a href="#md2" class="nav-link" data-toggle="tab">MD2</a>
									</li>
                                    <li class="nav-item">
										<a href="#md4" class="nav-link" data-toggle="tab">MD4</a>
									</li>
                                    <li class="nav-item">
										<a href="#crc32" class="nav-link" data-toggle="tab">CRC32</a>
									</li>
                                    <li class="nav-item">
										<a href="#gost" class="nav-link" data-toggle="tab">Gost</a>
									</li>
                                    <li class="nav-item">
										<a href="#snefru" class="nav-link" data-toggle="tab">Snefru</a>
									</li>
								</ul>
								<div class="tab-content">
                                    <br />
