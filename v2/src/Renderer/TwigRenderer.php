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

namespace Befree\Renderer;

/**
 * Class TwigRenderer
 * @package Befree\Renderer
 */
class TwigRenderer implements RendererInterface
{

    /**
     * @var \Twig_Environment
     */
    private $twig;


    /**
     * TwigRenderer constructor.
     */
    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(ROOT . '/Views', ROOT);
        $this->twig = new \Twig_Environment($loader, [
            'cache' => (ENV === 'production') ? RENDERER_CACHE_PATH : false,
            'debug' =>  ENV === 'development'
        ]);

        if (ENV === 'development') {
            $this->twig->addExtension(new \Twig_Extension_Debug());
        }

        $extensions = require_once(ROOT."/config/extensions.php");
        foreach ($extensions as $extension) {
            $this->twig->addExtension(new $extension());
        }
    }


    /**
     * @param string $view
     * @param array $params
     * @return mixed|void
     */
    public function render(string $view, array $params)
    {
        echo $this->twig->render("{$view}.twig", $params);
    }


    /**
     * @param string $key
     * @param $value
     * @return mixed|void
     */
    public function addGlobal(string $key, $value)
    {
        $this->twig->addGlobal($key, $value);
    }
}
