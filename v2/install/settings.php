<?php
include "core.php";
head();

@$_SESSION['username'] = $_POST['username'];
@$_SESSION['password'] = $_POST['password'];
?>
<center><h5><?php
echo lang_key("settings_info");
?></h5></center><br /><hr /><br />

    <form method="post" action="" class="form-horizontal row-border">

<div class="form-group row">
<h6 class="col-sm-3"><?php
echo lang_key("username");
?>: </h6>
<div class="col-sm-8">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text">
<i class="fas fa-user"></i>
</span>
</div>
<input type="text" name="username" class="form-control" placeholder="mahid_hm" value="<?php
echo $_SESSION['username'];
?>" required>
</div>
</div>
</div>
<div class="form-group row">
<h6 class="col-sm-3"><?php
echo lang_key("password");
?>: </h6>
<div class="col-sm-8">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text">
<i class="fas fa-key"></i>
</span>
</div>
<input type="password" name="password" class="form-control" placeholder="" value="<?php
echo $_SESSION['password'];
?>" required>
</div>
</div>
</div>

<?php
if (isset($_POST['submit'])) {
$username = $_POST['username'];
$password = $_POST['password'];

echo '<meta http-equiv="refresh" content="0; url=done.php" />';
}
?>

</div>
<div class="card-footer">
  <div class="row">
    <center>
      <a href="database.php" class="btn-secondary btn"><i class="fas fa-arrow-left"></i> <?php
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
