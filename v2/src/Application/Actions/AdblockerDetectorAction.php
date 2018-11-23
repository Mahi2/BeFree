<?php

namespace Befree\Actions;

use Befree\Repositories\AdblockerSettingsRepository;
use DI\Container;

/**
 * Class AdblockerDetectorAction
 * @package Befree\Actions
 */
class AdblockerDetectorAction extends Action
{

    /**
     * module name
     * @var string
     */
    protected $name = 'adblocker-detector';


    /**
     * AdblockerDetectorAction constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->settings = ($container->get(AdblockerSettingsRepository::class))->all();

        if ($this->realTimeProtection || $this->settings->detection) {
            $this->isActive = true;
            return $this;
        } else {
            return null;
        }
    }


    /**
     * run the protection action
     */
    public function run()
    {
        $redirect = $this->settings->redirect;
        echo $this->javascript($this->name);
    }
}
