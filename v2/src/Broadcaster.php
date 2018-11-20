<?php
namespace Befree;


use DI\Container;

class Broadcaster
{
    public function __construct(Container $container)
    {

    }

    public function emit()
    {
        $table = $prefix . 'settings';
        $squery = $mysqli->query("SELECT * FROM `$table`");
        $srow = $squery->fetch_assoc();

//Getting Real IP Address
        if ($srow['ip_detection'] == 2)
        {

            function psec_get_realip()
            {
                $ipaddress = '';
                if (getenv('HTTP_CLIENT_IP'))
                    $ipaddress = getenv('HTTP_CLIENT_IP');
                else if (getenv('HTTP_X_FORWARDED_FOR'))
                    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
                else if (getenv('HTTP_X_FORWARDED'))
                    $ipaddress = getenv('HTTP_X_FORWARDED');
                else if (getenv('HTTP_FORWARDED_FOR'))
                    $ipaddress = getenv('HTTP_FORWARDED_FOR');
                else if (getenv('HTTP_FORWARDED'))
                    $ipaddress = getenv('HTTP_FORWARDED');
                else if (getenv('REMOTE_ADDR'))
                    $ipaddress = getenv('REMOTE_ADDR');
                else
                    $ipaddress = $_SERVER['REMOTE_ADDR'];
                return $ipaddress;
            }
        }

//Getting Browser and Operating System
        include dirname(__FILE__) . '/lib/useragent.class.php';
        $useragent_data = UserAgentFactoryPS::analyze($_SERVER['HTTP_USER_AGENT']);

//Getting Visitor Information
        if ($srow['ip_detection'] == 2) {
            $ip = psec_get_realip();
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $page = $_SERVER['PHP_SELF'];
        $browser = $useragent_data->browser['title'];
        $browsersh = $useragent_data->browser['name'];
        $browser_code = $useragent_data->browser['code'];
        $os = $useragent_data->os['title'];
        $ossh = $useragent_data->os['name'] . " " . $useragent_data->os['version'];
        $os_code = $useragent_data->os['code'];
        @$useragent = $_SERVER['HTTP_USER_AGENT'];
        @$referer = $_SERVER["HTTP_REFERER"];
        @$date = @date("d F Y");
        @$time = @date("H:i");

        function psec_logging($mysqli, $prefix, $type)
        {
            global $ip, $page, $querya, $date, $time, $browser, $browser_code, $os, $os_code, $useragent, $referer;

            $ltable = $prefix . 'logs';
            $queryvalid = $mysqli->query("SELECT ip, page, query, type, date FROM `$ltable` WHERE ip='$ip' and page='$page' and query='$querya' and type='$type' and date='$date' LIMIT 1");
            if ($queryvalid->num_rows <= 0) {
                include_once "lib/ip_details.php";
                $log = $mysqli->query("INSERT INTO `$ltable` (`ip`, `date`, `time`, `page`, `query`, `type`, `browser`, `browser_code`, `os`, `os_code`, `country`, `country_code`, `region`, `city`, `latitude`, `longitude`, `isp`, `useragent`, `referer_url`) VALUES ('$ip', '$date', '$time', '$page', '$querya', '$type', '$browser', '$browser_code', '$os', '$os_code', '$country', '$country_code', '$region', '$city', '$latitude', '$longitude', '$isp', '$useragent', '$referer')");
            }
        }

        function psec_autoban($mysqli, $prefix, $type)
        {
            global $ip, $date, $time;

            $btable = $prefix . 'bans';
            $bansvalid = $mysqli->query("SELECT ip FROM `$btable` WHERE ip='$ip' LIMIT 1");
            if ($bansvalid->num_rows <= 0) {
                $log = $mysqli->query("INSERT INTO `$btable` (ip, date, time, reason, autoban) VALUES ('$ip', '$date', '$time', '$type', '1')");
            }
        }

        function psec_mail($mysqli, $prefix, $site_url, $projectsecurity_path, $type, $smail)
        {
            global $ip, $date, $time, $browser, $os, $page, $referer, $smail;

            $email = 'notifications@' . $_SERVER['SERVER_NAME'] . '';
            $to = $smail;
            $subject = 'BeFree - ' . $type . '';
            $message = '
					<p style="padding:0; margin:0 0 11pt 0;line-height:160%; font-size:18px;">Details of Log - ' . $type . '</p>
					<p>IP Address: <strong>' . $ip . '</strong></p>
					<p>Date: <strong>' . $date . '</strong> at <strong>' . $time . '</strong></p>
					<p>Browser:  <strong>' . $browser . '</strong></p>
					<p>Operating System:  <strong>' . $os . '</strong></p>
					<p>Threat Type:  <strong>' . $type . '</strong> </p>
					<p>Page:  <strong>' . $page . '</strong> </p>
                	<p>Referer URL:  <strong>' . $referer . '</strong> </p>
                	<p>Site URL:  <strong>' . $site_url . '</strong> </p>
                	<p>Project SECURITY URL:  <strong>' . $projectsecurity_path . '</strong> </p>
				';
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .= 'To: ' . $to . ' <' . $to . '>' . "\r\n";
            $headers .= 'From: ' . $email . ' <' . $email . '>' . "\r\n";
            @mail($to, $subject, $message, $headers);
        }

    }

}