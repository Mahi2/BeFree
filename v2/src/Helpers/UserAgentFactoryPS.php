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

namespace Befree\Helpers;

/**
 * Class UserAgentFactoryPS
 * @package Befree\Helpers
 */
class UserAgentFactoryPS
{
    /**
     * @param $string
     * @param null $imageSize
     * @param null $imagePath
     * @param null $imageExtension
     * @return UserAgentPS
     */
    public static function analyze($string, $imageSize = null, $imagePath = null, $imageExtension = null)
    {
        $class = new UserAgentPS();
        $imageSize === null || $class->imageSize = $imageSize;
        $imagePath === null || $class->imagePath = $imagePath;
        $imageExtension === null || $class->imageExtension = $imageExtension;
        $class->analyze($string);
        return $class;
    }
}
