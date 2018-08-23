<?php
include "core.php";
head();

@$_SESSION['database_host'] = $_POST['database_host'];
@$_SESSION['database_username'] = $_POST['database_username'];
@$_SESSION['database_password'] = $_POST['database_password'];
@$_SESSION['database_name'] = $_POST['database_name'];
@$_SESSION['table_prefix'] = $_POST['table_prefix'];
?>
