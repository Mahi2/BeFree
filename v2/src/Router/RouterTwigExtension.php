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


namespace Befree\Router;

/**
 * Class RouterTwigExtension
 * @package Befree\Router
 */
class RouterTwigExtension extends \Twig_Extension
{

    use RouterAwareTrait;


    /**
     * @inheritdoc
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_Function('path', [$this, 'pathFor']),
        ];
    }


    /**
     * create a url for a route path
     * @param string $path
     * @param array $param
     * @return mixed
     */
    public function pathFor(string $path, array $param = [])
    {
        $router = $this->getRouter();
        return "/{$router->url($path, $param)}";
    }
}
