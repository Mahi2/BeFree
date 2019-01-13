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

namespace Befree\Application\Controllers;

use Befree\Application\Repositories\SettingsRepository;
use Befree\Http\Request;
use Befree\Renderer\RendererInterface;
use Psr\Container\ContainerInterface;

/**
 * Class Controller
 * @package Befree\Applications\Controllers
 */
class Controller
{

    /**
     * @var ContainerInterface
     */
    protected $container;


    /**
     * modules load
     * @var array
     */
    protected $modules = [];


    /**
     * the current request
     * @var Request|mixed
     */
    protected $request;

    /**
     * general settings
     * @var SettingsRepository|mixed
     */
    private $settings;


    /**
     * Controller constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->renderer = $container->get(RendererInterface::class);
        $this->settings = $container->get(SettingsRepository::class);
        $this->request = $container->get(Request::class);
    }


    /**
     * render a view
     * @param string $view
     * @param array $data
     */
    protected function render(string $view, array $data = [])
    {
        echo $this->renderer->render($view, $data);
    }
}
