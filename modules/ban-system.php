<?php
//Ban System
$table       = $prefix . 'bans';
$querybanned = $mysqli->query("SELECT ip FROM `$table` WHERE ip='$ip' LIMIT 1");
if ($querybanned->num_rows > 0) {
    $bannedpage_url = $projectsecurity_path . "/pages/banned.php";
    echo '<meta http-equiv="refresh" content="0;url=' . $bannedpage_url . '" />';
    exit;
}

//Blocking Country
$table = $prefix . 'settings';
$query = $mysqli->query("SELECT `countryban_blacklist` FROM `$table` WHERE id='1' LIMIT 1");
$row   = $query->fetch_assoc();

$table1 = $prefix . 'bans-country';
$query1 = $mysqli->query("SELECT * FROM `$table1`");
$table2 = $prefix . 'bans-other';
$query2 = $mysqli->query("SELECT * FROM `$table2` WHERE type = 'isp'");
if ($query1->num_rows > 0 OR $query2->num_rows > 0) {
    $url = 'http://extreme-ip-lookup.com/json/' . $ip;
    $ch  = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    @curl_setopt($ch, CURLOPT_REFERER, "https://google.com");
    @$ipcontent = curl_exec($ch);
    curl_close($ch);

    $ip_data = @json_decode($ipcontent);
    if ($ip_data && $ip_data->{'status'} == 'success') {
        $country_check = $ip_data->{'country'};
        $isp_check     = $ip_data->{'isp'};
    } else {
        $country_check = "Unknown";
        $isp_check     = "Unknown";
    }

} else {
    @$isp_check = "Unknown";
    @$country_check = "Unknown";
}

$table = $prefix . 'bans-country';
@$querybanned = $mysqli->query("SELECT country FROM `$table` WHERE country='$country_check'");

if ($row['countryban_blacklist'] == 1) {
    if ($querybanned->num_rows > 0) {
        $bannedcpage_url = $projectsecurity_path . "/pages/banned-country.php";
        echo '<meta http-equiv="refresh" content="0;url=' . $bannedcpage_url . '" />';
        exit;
    }
} else {
    if (strpos(strtolower($useragent), "googlebot") !== false OR strpos(strtolower($useragent), "bingbot") !== false OR strpos(strtolower($useragent), "yahoo! slurp") !== false) {
    } else {
        if ($querybanned->num_rows <= 0) {
            $bannedcpage_url = $projectsecurity_path . "/pages/banned-country.php";
            echo '<meta http-equiv="refresh" content="0;url=' . $bannedcpage_url . '" />';
            exit;
        }
    }
}

//Blocking Browser
$table       = $prefix . 'bans-other';
$querybanned = $mysqli->query("SELECT * FROM `$table` WHERE type='browser' LIMIT 1");
while ($rowb = $querybanned->fetch_assoc()) {
    if (strpos(strtolower($browser), strtolower($rowb['value'])) !== false) {
        $blockedbpage_url = $projectsecurity_path . "/pages/blocked-browser.php";
        echo '<meta http-equiv="refresh" content="0;url=' . $blockedbpage_url . '" />';
        exit;
    }
}

//Blocking Operating System
$table       = $prefix . 'bans-other';
$querybanned = $mysqli->query("SELECT * FROM `$table` WHERE type='os' LIMIT 1");
while ($rowo = $querybanned->fetch_assoc()) {
    if (strpos(strtolower($os), strtolower($rowo['value'])) !== false) {
        $blockedopage_url = $projectsecurity_path . "/pages/blocked-os.php";
        echo '<meta http-equiv="refresh" content="0;url=' . $blockedopage_url . '" />';
        exit;
    }
}

//Blocking Internet Service Provider
$table       = $prefix . 'bans-other';
$querybanned = $mysqli->query("SELECT * FROM `$table` WHERE type='isp' LIMIT 1");
while ($rowi = $querybanned->fetch_assoc()) {
    if (strpos(strtolower($isp_check), strtolower($rowi['value'])) !== false) {
        $blockedipage_url = $projectsecurity_path . "/pages/blocked-isp.php";
        echo '<meta http-equiv="refresh" content="0;url=' . $blockedipage_url . '" />';
        exit;
    }
}

//Blocking Referrer
$table       = $prefix . 'bans-other';
$querybanned = $mysqli->query("SELECT * FROM `$table` WHERE type='referrer' LIMIT 1");
while ($rowr = $querybanned->fetch_assoc()) {
    if (strpos(strtolower(@$referer), strtolower($rowr['value'])) !== false) {
        $blockedrpage_url = $projectsecurity_path . "/pages/blocked-referrer.php";
        echo '<meta http-equiv="refresh" content="0;url=' . $blockedrpage_url . '" />';
        exit;
    }
}
?>
