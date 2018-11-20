<?php
namespace Befree;


use Befree\Helpers\UserAgentFactoryPS;
use Befree\Http\RequestAwareTrait;
use Befree\Repositories\BansRepository;
use Befree\Repositories\LogsRepository;
use Befree\Repositories\SettingsRepository;
use DI\Container;

/**
 * Class Broadcaster
 * @package Befree
 */
class Broadcaster
{

    /**
     * gives access to request data
     */
    use RequestAwareTrait;


    /**
     * @var Container
     */
    private $container;

    /**
     * @var SettingsRepository|mixed
     */
    private $settings;

    /**
     * @var LogsRepository|mixed
     */
    private $logs;

    /**
     * @var BansRepository|mixed
     */
    private $bans;

    /**
     * @var Http\Request
     */
    private $request;

    /**
     * Broadcaster constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->settings = $container->get(SettingsRepository::class);
        $this->logs = $container->get(LogsRepository::class);
        $this->bans = $container->get(BansRepository::class);
        $this->request = $this->getRequest();
    }


    /**
     * get some data about the user agent
     * @param string $key
     * @return string
     */
    public function getUserAgentData(string $key): string
    {
        $useragent = UserAgentFactoryPS::analyze($this->request->get('http.user.agent'));
        $data = [
            'page' => $this->request->get('php.self'),
            'browser' => $useragent->browser['title'],
            'browsersh' => $useragent->browser['name'],
            'browser_code' => $useragent->browser['code'],
            'os' => $useragent->os['title'],
            'ossh' => "{$useragent->os['name']} {$useragent->os['version']}",
            'os_code' => $useragent->os['code'],
            'useragent' => $this->request->get('http.user.agent'),
            'referer' => $this->request->get('http.referer'),
            'date' => (new \DateTime('now'))->format('d F Y'),
            'time' => (new \DateTime('now'))->format('H:i')
        ];

        if (array_key_exists($key, $data)) {
            return $data[$key];
        }
        return null;
    }


    /**
     * return the real ip of a user
     * @return array|false|null|string
     */
    public function getRealIp()
    {
        if ($this->settings->ip_detection == 2) {
            return getenv('HTTP_CLIENT_IP')
                ?? getenv('HTTP_X_FORWARDED_FOR')
                ?? getenv('HTTP_X_FORWARDED')
                ?? getenv('HTTP_FORWARDED_FOR')
                ?? getenv('HTTP_FORWARDED')
                ?? getenv('REMOTE_ADDR')
                ?? $this->request->get('remote.addr')
                ?? '';
        }
        return '';
    }


    public function emit()
    {

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