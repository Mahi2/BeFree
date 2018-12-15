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
 * Interface RendererInterface
 * @package Befree\Renderer
 */
interface RendererInterface
{
    /**
     * render a view
     * @param string $view
     * @param array $param
     * @return mixed
     */
    public function render(string $view, array $param);


    /**
     * define a global variable, accessible to any view
     * @param string $key
     * @param $value
     * @return mixed
     */
    public function addGlobal(string $key, $value);
}
