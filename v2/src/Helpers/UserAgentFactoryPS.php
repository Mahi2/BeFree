<?php

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
    public static function analyze($string, $imageSize = null, $imagePath = null, $imageExtension = null) {
        $class = new UserAgentPS();
        $imageSize === null || $class->imageSize = $imageSize;
        $imagePath === null || $class->imagePath = $imagePath;
        $imageExtension === null || $class->imageExtension = $imageExtension;
        $class->analyze($string);
        return $class;
    }
}