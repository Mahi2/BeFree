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

namespace Befree\Helpers;

use GuzzleHttp\Client;

/**
 * Class IpDetails
 * @package Befree\Helpers
 */
class IpDetails
{

    /**
     * get more details of an ip
     * @param string $ip
     * @param $useragent
     */
    public function __construct(string $ip, $useragent)
    {

        $api = new Client();
        $ipContent = $api->get("http://extreme-ip-lookup.com/json/{$ip}");
        $ip_data = @json_decode($ipContent);
        return [
            'country'      => $ip_data->{'country'} ?? "Unknown",
            'country_code' => $ip_data->{'countryCode'} ?? "XX",
            'region'       => $ip_data->{'region'} ?? "Unknown",
            'city'         => $ip_data->{'city'} ?? "Unknown",
            'latitude'     => $ip_data->{'lat'} ?? "0",
            'longitude'    => $ip_data->{'lon'} ?? "0",
            'isp'          => $ip_data->{'isp'} ?? "Unknown",
        ];
    }
}
