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
        		      <h1 class="m-0 text-dark"><i class="fas fa-code"></i> HTML Encrypter</h1>
        		    </div>
        		    <div class="col-sm-6">
        		      <ol class="breadcrumb float-sm-right">
        		        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Admin Panel</a></li>
        		        <li class="breadcrumb-item active">HTML Encrypter</li>
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
							<h3 class="card-title">HTML Encrypter</h3>
						</div>
						<div class="card-body">
						<div class="row">
						      <div class="col-md-8">
                              <form method="post" class="form-horizontal form-bordered">
                                  <?php
@$_SESSION['htmltext-session'] = $_POST['htmltext'];
?>
                                        <textarea class="form-control" name="htmltext" rows="10" type="text" required><?php
echo $_SESSION['htmltext-session'];
?></textarea>

<?php
if (isset($_POST['encrypt'])) {

    $htmltext = $_POST['htmltext'];
    $a        = "";
    $b        = "";
    for ($i = 0; $i < strlen($htmltext); $i++) {
        $a = (string) dechex(ord($htmltext[$i]));
        switch (strlen($a)) {
            case 1:
                $b .= "\\u000" . $a;
                break;
            case 2:
                $b .= "\\u00" . $a;
                break;
            case 3:
                $b .= "\\u0" . $a;
                break;
            case 4:
                $b .= "\\u" . $a;
                break;
            default:
        }
    }
    $encrypted = "
<script type=\"text/javascript\">
<!-- HTML Encrypted by BeFree -->
<!--
document.write('{$b}')
//-->
</script>
";

    echo '<br /><br />
<strong>Encrypted HTML Code:</strong>
<textarea class="form-control" name="htmltext-encrypted" rows="10" type="text" readonly>' . $encrypted . '</textarea>
</script>
';

}
?>
									</div>
                                    <div class="col-md-4">
                                    <p>
                                        <ol>
                                        <li>Insert your HTML code you want to encrypt.
                                        <li>Click <strong>Encrypt</strong> and copy and paste the <strong>Encrypted HTML Code</strong> to your website.</li>
                                        </ol>
                                    </p>
                                    </div>
                             </div>
                        </div>
                        <div class="card-footer">
				              <input class="btn btn-flat btn-primary" type="submit" name="encrypt" value="Encrypt">
                              <button type="reset" class="btn btn-flat btn-default">Reset</button>
				        </div>
                        </form>
                     </div>
                </div>

				<div class="col-md-3">
				     <div class="card">
						<div class="card-header">
							<h3 class="card-title">Information & Tips</h3>
						</div>
				        <div class="card-body">
				              <strong>HTML Encryption</strong> means you can convert your web page contents to a non-easily understandable format. This may protect your code from being stolen by others upto great extent. The one limitation of it is that your page will be seen on JavaScript enabled browsers only.
                        </div>
				     </div>
				</div>
				</div>

				</div>
				<!--===================================================-->
				<!--End page content-->


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
