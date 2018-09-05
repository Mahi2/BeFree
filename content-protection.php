<?php
require("core.php");
head();

if (isset($_POST['save'])) {
    $table = $prefix . 'content-protection';

    if (isset($_POST['rightclick-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    if (isset($_POST['rightclick-alert'])) {
        $alert = 1;
    } else {
        $alert = 0;
    }
    $message = $_POST['rightclick-message'];
    $update  = $mysqli->query("UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=1");

    if (isset($_POST['rightclick_images-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    if (isset($_POST['rightclick_images-alert'])) {
        $alert = 1;
    } else {
        $alert = 0;
    }
    $message = $_POST['rightclick_images-message'];
    $update  = $mysqli->query("UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=2");

    if (isset($_POST['cut-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    if (isset($_POST['cut-alert'])) {
        $alert = 1;
    } else {
        $alert = 0;
    }
    $message = $_POST['cut-message'];
    $update  = $mysqli->query("UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=3");

    if (isset($_POST['copy-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    if (isset($_POST['copy-alert'])) {
        $alert = 1;
    } else {
        $alert = 0;
    }
    $message = $_POST['copy-message'];
    $update  = $mysqli->query("UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=4");

    if (isset($_POST['paste-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    if (isset($_POST['paste-alert'])) {
        $alert = 1;
    } else {
        $alert = 0;
    }
    $message = $_POST['paste-message'];
    $update  = $mysqli->query("UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=5");

    if (isset($_POST['drag-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    $update = $mysqli->query("UPDATE `$table` SET enabled='$enabled' WHERE id=6");

    if (isset($_POST['drop-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    $update = $mysqli->query("UPDATE `$table` SET enabled='$enabled' WHERE id=7");

    if (isset($_POST['printscreen-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    if (isset($_POST['printscreen-alert'])) {
        $alert = 1;
    } else {
        $alert = 0;
    }
    $message = $_POST['printscreen-message'];
    $update  = $mysqli->query("UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=8");

    if (isset($_POST['print-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    if (isset($_POST['print-alert'])) {
        $alert = 1;
    } else {
        $alert = 0;
    }
    $message = $_POST['print-message'];
    $update  = $mysqli->query("UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=9");

    if (isset($_POST['view_source-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    if (isset($_POST['view_source-alert'])) {
        $alert = 1;
    } else {
        $alert = 0;
    }
    $message = $_POST['view_source-message'];
    $update  = $mysqli->query("UPDATE `$table` SET enabled='$enabled', alert='$alert', message='$message' WHERE id=10");

    if (isset($_POST['iframe_out-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    $update = $mysqli->query("UPDATE `$table` SET enabled='$enabled' WHERE id=11");

    if (isset($_POST['selecting-enabled'])) {
        $enabled = 1;
    } else {
        $enabled = 0;
    }
    $update = $mysqli->query("UPDATE `$table` SET enabled='$enabled' WHERE id=12");

	if (isset($_POST['jquery_include'])) {
        $jquery_include = 1;
    } else {
        $jquery_include = 0;
    }

	$table2 = $prefix . 'settings';
    $query2 = $mysqli->query("UPDATE `$table2` SET jquery_include='$jquery_include' WHERE id=1");
}
?>
