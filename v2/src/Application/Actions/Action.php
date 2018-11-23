<?php

namespace Befree\Actions;

use Befree\Broadcaster;
use Befree\Renderer\TwigRenderer;
use Befree\Repositories\SettingsRepository;
use DI\Container;

/**
 * Class Action
 * @package Befree\Actions
 */
class Action
{

    /**
     * the name of the module, this name is used to
     * load befree module javascript and befree module error view
     * @var string
     */
    protected $name;


    /**
     * whether the user has actived this protection action.
     * @var bool
     */
    protected $isActive;


    /**
     * the configuration of befree set by the user.
     * @var SettingsRepository
     */
    protected $setting;


    /**
     * whether the user has actived the realTime protection.
     * @var bool
     */
    public $realTimeProtection = false;


    /**
     * Action constructor.
     * @param Container $container
     * @internal param bool $realTimeProtection
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->broadcaster = $container->get(Broadcaster::class);
        $this->settings = ($container->get(SettingsRepository::class))->all();
        $this->realTimeProtection = $this->settings->realtime_protection;
    }


    /**
     * if an action need a javascript action.
     * @param string $filename
     * @return null|string
     */
    protected function javascript(string $filename): ?string
    {
        if (file_exists($filename)) {
            ob_start();
                require($filename);
            return ob_get_clean();
        }
        return null;
    }


    /**
     * render a html view
     * @param string $filename
     * @param array $params
     */
    protected function view(string $filename, array $params = []): void
    {
        $renderer = $this->container->get(TwigRenderer::class);
        $renderer->render($filename, $params);
    }
}
