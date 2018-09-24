<?php
//Content Protection
$table = $prefix . 'content-protection';
$query = $mysqli->query("SELECT * FROM `$table`");

if ($srow['jquery_include'] == 1) {
    echo '<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>';
}

?>
