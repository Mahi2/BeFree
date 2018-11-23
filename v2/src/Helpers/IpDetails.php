<?php

namespace Befree\Helpers;

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
        $url = "http://extreme-ip-lookup.com/json/{$ip}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_REFERER, "https://google.com");
        $ipContent = curl_exec($ch);
        curl_close($ch);

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
