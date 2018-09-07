<?php
include "config.php";
include "modules/core.php";

//Checking if the visitor is in the Whitelist
$wtable = $prefix . 'ip-whitelist';
$wquery = $mysqli->query("SELECT ip FROM `$wtable` WHERE ip='$ip' LIMIT 1");
if ($wquery->num_rows <= 0){
    
    //Ban System
    include "modules/ban-system.php";
    
    $table  = $prefix . 'settings';
    $squery = $mysqli->query("SELECT * FROM `$table` LIMIT 1");
    $srow   = $squery->fetch_assoc();
    
    //Error Reporting
    if ($srow['error_reporting'] == 1) {
        @error_reporting(0);
    }
    if ($srow['error_reporting'] == 2) {
        @error_reporting(E_ERROR | E_WARNING | E_PARSE);
    }
    if ($srow['error_reporting'] == 3) {
        @error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    }
    if ($srow['error_reporting'] == 4) {
        @error_reporting(E_ALL & ~E_NOTICE);
    }
    if ($srow['error_reporting'] == 5) {
        @error_reporting(E_ALL);
    }
	
	//Displaying Errors
	if ($srow['display_errors'] == 1) {
	    @ini_set('display_errors', '1');
    } else {
	    @ini_set('display_errors', '0');
    }
    
    //Checking if Project SECURITY is enabled
    if ($srow['realtime_protection'] == 1) {
        include "modules/sqli-protection.php";
        include "modules/proxy-protection.php";
        include "modules/spam-protection.php";
		include "modules/massrequests-protection.php";
        include "modules/tor-detection.php";
        include "modules/badbots-protection.php";
        include "modules/fakebots-protection.php";
        include "modules/headers-check.php";
		include "modules/content-protection.php";
		include "modules/adblocker-detector.php";
		include "modules/live-traffic.php";
    }
    
}
?>