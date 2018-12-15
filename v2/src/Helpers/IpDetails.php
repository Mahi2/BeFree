<?php

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
