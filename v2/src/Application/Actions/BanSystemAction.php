<?php

namespace Befree\Actions;

use Befree\Repositories\BansCountryRepository;
use Befree\Repositories\BansOtherRepository;
use Befree\Repositories\BansRepository;
use Befree\Repositories\SettingsRepository;
use DI\Container;


/**
 * Class BanSystemAction
 * @package Befree\Actions
 */
class BanSystemAction extends Action
{

    /**
     * @inheritDoc
     * @var string
     */
    protected $name = "bad-system";

    /**
     * @var SettingsRepository|mixed
     */
    protected $settings;

    /**
     * @var BansRepository|mixed
     */
    private $bans;

    /**
     * @var BansCountryRepository|mixed
     */
    private $bansCountry;

    /**
     * @var BansOtherRepository|mixed
     */
    private $bansOther;


    /**
     * BanSystemAction constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->settings = ($container->get(SettingsRepository::class))->all();
        $this->bans = $container->get(BansRepository::class);
        $this->bansCountry = $container->get(BansCountryRepository::class);
        $this->bansOther = $container->get(BansOtherRepository::class);

        if ($this->settings->realtime_protection) {
            $this->isActive = true;
            return $this;
        }
        return null;
    }


    /**
     * block user of a country to acces to our application
     */
    private function blockingCountry()
    {
        $useragent = $this->broadcaster->getUserAgentData('useragent');
        $countries = $this->bansCountry->all();
        $other = $this->bansOther->findWith('type', 'isp');

        if ($countries || $other) {
            $url = "http://extreme-ip-lookup.com/json/{$this->broadcaster->getRealIp()}";
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
            $country_check = $ip_data->{'country'} ?? "Unknown";
            $isp_check     = $ip_data->{'isp'} ?? "Unknown";

        } else {
            @$isp_check = "Unknown";
            @$country_check = "Unknown";
        }

        if ($this->settings->countryban_blacklist) {
            if ($this->bansCountry->findWith('country', $country_check)) {
                $this->view($this->name, ['page' => 'banned-country']);
                exit();
            }
        }  else {
            if (strpos(strtolower($useragent), "googlebot")
                == false || strpos(strtolower($useragent), "bingbot")
                == false || strpos(strtolower($useragent), "yahoo! slurp")
                == false
            ) {
                $this->view($this->name, ['page' => 'bannded-country']);
                exit();
            }
        }
    }


    /**
     * run protection actions
     */
    public function run()
    {
        $this->blockingCountry();
    }

}