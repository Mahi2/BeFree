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
                                    <?php
                                    if (isset($_POST['generate'])) {
                                        $string = $_POST['string'];
                                        echo '
                                    									<div id="md5" class="tab-pane active show">
                                                                            Generated MD5 Hash:<br />
                                    										<input value="' . md5($string) . '" name="md5" class="form-control" disabled>
                                    									</div>
                                    									<div id="base64" class="tab-pane">
                                                                            Generated Base64 Hash:<br />
                                    										<input value="' . base64_encode($string) . '" name="base64" class="form-control" disabled>
                                    									</div>
                                                                        <div id="sha-1" class="tab-pane">
                                                                            Generated SHA-1 Hash:<br />
                                    										<input value="' . hash('sha1', $string) . '" name="sha-1" class="form-control" disabled>
                                    									</div>
                                                                        <div id="sha-256" class="tab-pane">
                                                                            Generated SHA-256 Hash:<br />
                                    										<input value="' . hash('sha256', $string) . '" name="sha-256" class="form-control" disabled>
                                    									</div>
                                                                        <div id="sha-512" class="tab-pane">
                                                                            Generated SHA-512 Hash:<br />
                                    										<input value="' . hash('sha512', $string) . '" name="sha-512" class="form-control" disabled>
                                    									</div>
                                                                        <div id="whirlpool" class="tab-pane">
                                                                            Generated Whirlpool Hash:<br />
                                    										<input value="' . hash('Whirlpool', $string) . '" name="whirlpool" class="form-control" disabled>
                                    									</div>
                                                                        <div id="crypt" class="tab-pane">
                                                                            Generated Crypt Hash:<br />
                                    										<input value="' . @crypt($string) . '" name="crypt" class="form-control" disabled>
                                    									</div>
                                                                        <div id="md2" class="tab-pane">
                                                                            Generated MD2 Hash:<br />
                                    										<input value="' . hash('md2', $string) . '" name="md2" class="form-control" disabled>
                                    									</div>
                                                                        <div id="md4" class="tab-pane">
                                                                            Generated MD4 Hash:<br />
                                    										<input value="' . hash('md4', $string) . '" name="md4" class="form-control" disabled>
                                    									</div>
                                                                        <div id="crc32" class="tab-pane">
                                                                            Generated CRC32 Hash:<br />
                                    										<input value="' . hash('crc32', $string) . '" name="crc32" class="form-control" disabled>
                                    									</div>
                                                                        <div id="gost" class="tab-pane">
                                                                            Generated Gost Hash:<br />
                                    										<input value="' . hash('gost', $string) . '" name="gost" class="form-control" disabled>
                                    									</div>
                                                                        <div id="snefru" class="tab-pane">
                                                                            Generated Gost Hash:<br />
                                    										<input value="' . hash('snefru', $string) . '" name="snefru" class="form-control" disabled>
                                    									</div>
                                    ';
                                    } else {
                                        echo '
                                    									<div id="md5" class="tab-pane active">
                                                                            Generated MD5 Hash:<br />
                                    										<input name="md5" class="form-control" disabled>
                                    									</div>
                                    									<div id="base64" class="tab-pane">
                                                                            Generated Base64 Hash:<br />
                                    										<input name="base64" class="form-control" disabled>
                                    									</div>
                                                                        <div id="sha-1" class="tab-pane">
                                                                            Generated SHA-1 Hash:<br />
                                    										<input name="sha-1" class="form-control" disabled>
                                    									</div>
                                                                        <div id="sha-256" class="tab-pane">
                                                                            Generated SHA-256 Hash:<br />
                                    										<input name="sha-256" class="form-control" disabled>
                                    									</div>
                                                                        <div id="sha-512" class="tab-pane">
                                                                            Generated SHA-512 Hash:<br />
                                    										<input name="sha-512" class="form-control" disabled>
                                    									</div>
                                                                        <div id="whirlpool" class="tab-pane">
                                                                            Generated Whirlpool Hash:<br />
                                    										<input name="whirlpool" class="form-control" disabled>
                                    									</div>
                                                                        <div id="crypt" class="tab-pane">
                                                                            Generated Crypt Hash:<br />
                                    										<input name="crypt" class="form-control" disabled>
                                    									</div>
                                                                        <div id="md2" class="tab-pane">
                                                                            Generated MD2 Hash:<br />
                                    										<input name="md2" class="form-control" disabled>
                                    									</div>
                                                                        <div id="md4" class="tab-pane">
                                                                            Generated MD4 Hash:<br />
                                    										<input name="md4" class="form-control" disabled>
                                    									</div>
                                                                        <div id="crc32" class="tab-pane">
                                                                            Generated CRC32 Hash:<br />
                                    										<input name="crc32" class="form-control" disabled>
                                    									</div>
                                                                        <div id="gost" class="tab-pane">
                                                                            Generated Gost Hash:<br />
                                    										<input name="gost" class="form-control" disabled>
                                    									</div>
                                                                        <div id="snefru" class="tab-pane">
                                                                            Generated Gost Hash:<br />
                                    										<input name="snefru" class="form-control" disabled>
                                    									</div>
                                    ';
                                    }
                                    ?>
                                  </div>
                                  							</div>

                                                          </div>
                                                       </div>

                                                      <div class="card">
                                  						<div class="card-header">
                                  							<h3 class="card-title">Cryptographic Hash Functions</h3>
                                  						</div>
                                  						<div class="card-body">
                                                                               <table class="table table-bordered table-hover">
                                  												<thead>
                                  													<tr>
                                  														<th>Name</th>
                                  														<th>Length</th>
                                  														<th>Type</th>
                                  													</tr>
                                  												</thead>
                                  												<tbody>
                                  <tr>
                                  <td>BLAKE-256</td>
                                  <td>256 bits</td>
                                  <td>HAIFA structure</td>
                                  </tr>
                                  <tr>
                                  <td>BLAKE-512</td>
                                  <td>512 bits</td>
                                  <td>HAIFA structure</td>
                                  </tr>
                                  <tr>
                                  <td>ECOH</td>
                                  <td>224 to 512 bits</td>
                                  <td>hash</td>
                                  </tr>
                                  <tr>
                                  <td>FSB</td>
                                  <td>160 to 512 bits</td>
                                  <td>hash</td>
                                  </tr>
                                  <tr>
                                  <td>GOST</td>
                                  <td>256 bits</td>
                                  <td>hash</td>
                                  </tr>
                                  <tr>
                                  <td>Grøstl</td>
                                  <td>256 to 512 bits</td>
                                  <td>hash</td>
                                  </tr>
                                  <tr>
                                  <td>HAS-160</td>
                                  <td>160 bits</td>
                                  <td>hash</td>
                                  </tr>
                                  <tr>
                                  <td>HAVAL</td>
                                  <td>128 to 256 bits</td>
                                  <td>hash</td>
                                  </tr>
                                  <tr>
                                  <td>JH</td>
                                  <td>512 bits</td>
                                  <td>hash</td>
                                  </tr>
                                  <tr>
                                  <td>MD2</td>
                                  <td>128 bits</td>
                                  <td>hash</td>
                                  </tr>
                                  <tr>
                                  <td>MD4</td>
                                  <td>128 bits</td>
                                  <td>hash</td>
                                  </tr>
                                  <tr>
                                  <td>MD5</td>
                                  <td>128 bits</td>
                                  <td>Merkle-Damgård construction</td>
                                  </tr>
                                  <tr>
                                  <td>MD6</td>
                                  <td>512 bits</td>
                                  <td>Merkle tree NLFSR</td>
                                  </tr>
                                  <tr>
                                  <td>RadioGatún</td>
                                  <td>Up to 1216 bits</td>
                                  <td>hash</td>
                                  </tr>
                                  <tr>
                                  <td>RIPEMD-64</td>
                                  <td>64 bits</td>
                                  <td>hash</td>
                                  </tr>
                                  <tr>
                                  <td>RIPEMD-160</td>
                                  <td>160 bits</td>
                                  <td>hash</td>
                                  </tr>
                                  <tr>
                                  <td>RIPEMD-320</td>
                                  <td>320 bits</td>
                                  <td>hash</td>
                                  </tr>
                                  <tr>
                                  <td>SHA-1</td>
                                  <td>160 bits</td>
                                  <td>Merkle-Damgård construction</td>
                                  </tr>
                                  <tr>
                                  <td>SHA-224</td>
                                  <td>224 bits</td>
                                  <td>Merkle-Damgård construction</td>
                                  </tr>
                                  <tr>
                                  <td>SHA-256</td>
                                  <td>256 bits</td>
                                  <td>Merkle-Damgård construction</td>
                                  </tr>
                                  <tr>
                                  <td>SHA-384</td>
                                  <td>384 bits</td>
                                  <td>Merkle-Damgård construction</td>
                                  </tr>
                                  <tr>
                                  <td>SHA-512</td>
                                  <td>512 bits</td>
                                  <td>Merkle-Damgård construction</td>
                                  </tr>
                                  <tr>
                                  <td>SHA-3 (originally known as Keccak)</td>
                                  <td>arbitrary</td>
                                  <td>Sponge function</td>
                                  </tr>
                                  <tr>
                                  <td>Skein</td>
                                  <td>arbitrary</td>
                                  <td>Unique Block Iteration</td>
                                  </tr>
                                  <tr>
                                  <td>SipHash</td>
                                  <td>64 bits</td>
                                  <td>non-collision-resistant PRF</td>
                                  </tr>
                                  <tr>
                                  <td>Snefru</td>
                                  <td>128 or 256 bits</td>
                                  <td>hash</td>
                                  </tr>
                                  <tr>
                                  <td>Spectral Hash</td>
                                  <td>512 bits</td>
                                  <td>Wide Pipe Merkle-Damgård construction</td>
                                  </tr>
                                  <tr>
                                  <td>SWIFFT</td>
                                  <td>512 bits</td>
                                  <td>hash</td>
                                  </tr>
                                  <tr>
                                  <td>Tiger</td>
                                  <td>192 bits</td>
                                  <td>Merkle-Damgård construction</td>
                                  </tr>
                                  <tr>
                                  <td>Whirlpool</td>
                                  <td>512 bits</td>
                                  <td>hash</td>
                                  </tr>
                                  												</tbody>
                                  											</table>
                                                          </div>
                                                       </div>
                                                  </div>

                                  				<div class="col-md-3">
                                  				     <div class="card">
                                  						<div class="card-header">
                                  							<h3 class="card-title">Information & Tips</h3>
                                  						</div>
                                  				        <div class="card-body">
                                  							Producing hash values for accessing data or for security. A hash value (or simply hash), also called a message digest, is a number generated from a string of text. The hash is substantially smaller than the text itself, and is generated by a formula in such a way that it is extremely unlikely that some other text will produce the same hash value.
                                                          </div>
                                  				     </div>
                                                       <div class="card">
                                  						<div class="card-header">
                                  							<h3 class="card-title">Purposes</h3>
                                  						</div>
                                  				        <div class="card-body">
                                  				            Hashing can be used for many purposes:
                                                                      <ul>
                                                                      <li>
                                                                      It can be used to compare large amounts of data. You create the hashes for the data, store the hashes and later if you want to compare the data, you just compare the hashes.
                                                                      </li>
                                                                      <li>
                                                                      Hashes can be used to index data. They can be used in hash tables to point to the correct row. If you want to quickly find a record, you calculate the hash of the data and directly go to the record where the corresponding hash record is pointing to. (This assumes that you have a sorted list of hashes that point to the actual records)
                                                                      </li>
                                                                      <li>
                                                                      They can be used in cryptographic applications like digital signatures.
                                                                      </li>
                                                                      <li>
                                                                      Hashing can be used to generate seemingly random strings.
                                                                      </li>
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
                                  <?php
                                  footer();
                                  ?>
