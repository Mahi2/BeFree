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
