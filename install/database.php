<?php
include "core.php";
head();

@$_SESSION['database_host'] = $_POST['database_host'];
@$_SESSION['database_username'] = $_POST['database_username'];
@$_SESSION['database_password'] = $_POST['database_password'];
@$_SESSION['database_name'] = $_POST['database_name'];
@$_SESSION['table_prefix'] = $_POST['table_prefix'];
?>
<center><h5><?php
echo lang_key("database_info");
?></h5></center><br /><hr /><br />

<form method="post" action="" class="form-horizontal row-border">

<div class="form-group row">
<h6 class="col-sm-3"><?php
echo lang_key("database_host");
?>: </h6>
<div class="col-sm-8">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text">
<i class="fas fa-database"></i>
</span>
</div>
<input type="text" name="database_host" class="form-control" placeholder="localhost" value="<?php
echo $_SESSION['database_host'];
?>" required>
</div>
</div>
</div>
<div class="form-group row">
<h6 class="col-sm-3"><?php
echo lang_key("database_name");
?>: </h6>
<div class="col-sm-8">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text">
<i class="fas fa-list-alt"></i>
</span>
</div>
<input type="text" name="database_name" class="form-control" placeholder="security" value="<?php
echo $_SESSION['database_name'];
?>" required>
</div>
</div>
</div>
<div class="form-group row">
<h6 class="col-sm-3"><?php
echo lang_key("database_username");
?>: </h6>
<div class="col-sm-8">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text">
<i class="fas fa-user"></i>
</span>
</div>
<input type="text" name="database_username" class="form-control" placeholder="root" value="<?php
echo $_SESSION['database_username'];
?>" required>
</div>
</div>
</div>
<div class="form-group row">
<h6 class="col-sm-3"><?php
echo lang_key("database_password");
?>: </h6>
<div class="col-sm-8">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text">
<i class="fas fa-key"></i>
</span>
</div>
<input type="text" name="database_password" class="form-control" placeholder="" value="<?php
echo $_SESSION['database_password'];
?>">
</div>
</div>
</div>
<div class="form-group row">
<h6 class="col-sm-3"><?php
echo lang_key("table_prefix");
?>: </h6>
<div class="col-sm-8">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text">
<i class="fas fa-terminal"></i>
</span>
</div>
<input type="text" name="table_prefix" class="form-control" placeholder="security_" value="<?php
echo $_SESSION['table_prefix'];
?>">
</div>
</div>
</div>
<?php
if (isset($_POST['submit'])) {
    $database_host     = $_POST['database_host'];
    $database_name     = $_POST['database_name'];
    $database_username = $_POST['database_username'];
    $database_password = $_POST['database_password'];

    $table_prefix = $_POST['table_prefix'];

	@$db = mysqli_connect($database_host, $database_username, $database_password, $database_name);
    if (!$db) {
        echo '
			   <br />
			    <div class="alert alert-danger">
					' . lang_key("error_check_db_connection") . '
			    </div>
			   ';
    } else {
        echo '<meta http-equiv="refresh" content="0; url=settings.php" />';
    }
}
?>

				</div>
				<div class="card-footer">
					<div class="row">
						<center>
							<a href="index.php" class="btn-secondary btn"><i class="fas fa-arrow-circle-left"></i> <?php
echo lang_key("back");
?></a>
							<input class="btn-primary btn" type="submit" name="submit" value="<?php
echo lang_key("next");
?>" />
						</center>
					</div>
				</div>
				</form>


<?php
footer();
?>
