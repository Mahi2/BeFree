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

namespace Befree\Applications\Actions;

use Befree\Broadcaster;
use Befree\Renderer\TwigRenderer;
use Befree\Repositories\SettingsRepository;
use DI\Container;

/**
 * Class Action
 * @package Befree\Applications\Actions
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
