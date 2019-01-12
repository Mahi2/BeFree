<?php
/**
 *   This file is part of the Befree.
 *
 *   @copyright   Henrique Mukanda <mahi2hm@outlook.fr>
 *   @copyright   Bernard ngandu <ngandubernard@gmail.com>
 *   @link    https://github.com/Mahi2/BeFree
 *   @link    https://github.com/bernard-ng/Befree
 *   @license   http://framework.zend.com/license/new-bsd New BSD License
 *
 *   For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 */

namespace Befree;

use Befree\Helpers\IpDetails;
use Befree\Helpers\UserAgentFactoryPS;
use Befree\Http\RequestAwareTrait;
use Befree\Application\Repositories\BansRepository;
use Befree\Application\Repositories\LogsRepository;
use Befree\Application\Repositories\SettingsRepository;
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
        $this->logs = $container->get(LogsRepository::class);
        $this->bans = $container->get(BansRepository::class);
        $this->request = $this->getRequest();
        $this->settings = $container->get(SettingsRepository::class);
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


    /**
     * add a log to the database log systeme
     * @param string $type
     */
    public function logging(string $type)
    {
        $data = [
            'ip' => $this->getRealIp(),
            'page' => $this->getUserAgentData('page'),
            'querya' => '',
            'date' => $this->getUserAgentData('date'),
            'time' => $this->getUserAgentData('time'),
            'browser' => $this->getUserAgentData('browser'),
            'browser_code' => $this->getUserAgentData('browser_code'),
            'os' => $this->getUserAgentData('os'),
            'os_code' => $this->getUserAgentData('os_code'),
            'useragent' => $this->getUserAgentData('useragent'),
            'referer' => $this->getUserAgentData('referer')
        ];

        $this->logs->create(array_merge($data, new IpDetails($data['ip'], $data['useragent'])));

        /*$ltable = $prefix . 'logs';
        $queryvalid = $mysqli->query("SELECT ip, page, query, type, date FROM `$ltable` WHERE ip='$ip' and page='$page' and query='$querya' and type='$type' and date='$date' LIMIT 1");
        if ($queryvalid->num_rows <= 0) {
            include_once "lib/ip_details.php";
            $log = $mysqli->query("INSERT INTO `$ltable` (`ip`, `date`, `time`, `page`, `query`, `type`, `browser`, `browser_code`, `os`, `os_code`, `country`, `country_code`, `region`, `city`, `latitude`, `longitude`, `isp`, `useragent`, `referer_url`) VALUES ('$ip', '$date', '$time', '$page', '$querya', '$type', '$browser', '$browser_code', '$os', '$os_code', '$country', '$country_code', '$region', '$city', '$latitude', '$longitude', '$isp', '$useragent', '$referer')");
        }*/
    }


    /**
     * autoban a user using his ip
     * @param string $type
     */
    public function autoBan(string $type)
    {
        $data = [
            'ip' => $this->getRealIp(),
            'date' => $this->getUserAgentData('date'),
            'time' => $this->getUserAgentData('time'),
            'reason' => $type,
            'autoban' => '1'
        ];

        $isBanded = $this->bans->findWith('ip', $data['ip']);
        if (!$isBanded) {
            $this->bans->create($data);
        }
    }


    /**
     * notify the user via mail
     * @param string $type
     * @param string $mail
     */
    public function emailNotify(string $type, string $mail)
    {
        $data = [
            'ip' => $this->getRealIp(),
            'date' => $this->getUserAgentData('date'),
            'time' => $this->getUserAgentData('time'),
            'browser' => $this->getUserAgentData('browser'),
            'os' => $this->getUserAgentData('os'),
            'page' => $this->getUserAgentData('page'),
            'referer' => $this->getUserAgentData('referer')
        ];

        $site_url = SITE_URL;
        $befree_path = BEFREE_URL;
        $email = "notifications@{$this->request->get('server.name')}";
        $to = $mail;
        $subject = "Befree - {$type}";
        $message = <<< EOF
<p style="padding:0; margin:0 0 11pt 0;line-height:160%; font-size:18px;">Details of Log - {$type} </p>
<p>IP Address: <strong>{$data['ip']}</strong></p>
<p>Date: <strong>{$data['date']}</strong> at <strong>{$data['time']}</strong></p>
<p>Browser:  <strong>{$data['browser']}</strong></p>
<p>Operating System:  <strong>{$data['os']}</strong></p>
<p>Threat Type:  <strong>{$type}</strong> </p>
<p>Page:  <strong>{$data['page']}</strong> </p>
<p>Referer URL:  <strong>{$data['referer']}</strong> </p>
<p>Site URL:  <strong>{$site_url}</strong> </p>
<p>Project SECURITY URL:  <strong>{$befree_path}</strong> </p>
EOF;

        $headers = "MIME-Version: 1.0 \r\n";
        $headers .= "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "To: {$to}  <{$to}> \r\n";
        $headers .= "From: {$email} <{$email}> \r\n";
        @mail($to, $subject, $message, $headers);
    }
}
