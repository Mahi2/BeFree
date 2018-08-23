<?php
include "core.php";
head();

@$_SESSION['username'] = $_POST['username'];
@$_SESSION['password'] = $_POST['password'];
?>
