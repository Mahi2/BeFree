<?php

namespace Befree\Helpers;

/**
 * Class UserAgentPS
 * @package Befree\Helpers
 */
class UserAgentPS
{
    /**
     * @var string
     */
    private $_imagePath = "";

    /**
     * @var int
     */
    private $_imageSize = 16;

    /**
     * @var string
     */
    private $_imageExtension = ".png";

    /**
     * @var array
     */
    private $_data = [];


    /**
     * UserAgentPS constructor.
     */
    public function __construct()
    {
        $this->_imagePath = 'img/';
    }


    /**
     * @param $param
     * @return mixed|null|string
     */
    public function __get($param)
    {
        $privateParam = '_' . $param;
        switch ($param) {
            case 'imagePath':
                return $this->_imagePath . $this->_imageSize . '/';
                break;
            default:
                if (isset($this->$privateParam)) {
                    return $this->$privateParam;
                } elseif (isset($this->_data[$param])) {
                    return $this->_data[$param];
                }
                break;
        }
        return null;
    }


    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $trueName = '_' . $name;
        if (isset($this->$trueName)) {
            $this->$trueName = $value;
        }
    }


    /**
     * @param $dir
     * @param $code
     * @return string
     */
    private function _makeImage($dir, $code)
    {
        return $this->imagePath . $dir . '/' . $code . $this->imageExtension;
    }


    /**
     * makes a platform
     */
    private function _makePlatform()
    {
        $this->_data['platform'] = &$this->_data['device'];
        if ($this->_data['device']['title'] != '') {
            $this->_data['platform'] = &$this->_data['device'];
        } elseif ($this->_data['os']['title'] != '') {
            $this->_data['platform'] = &$this->_data['os'];
        } else {
            $this->_data['platform'] = array(
                "link" => "#",
                "title" => "Unknown",
                "code" => "null",
                "dir" => "browser",
                "type" => "os",
                "image" => $this->_makeImage('browser', 'null'),
            );
        }
    }


    /**
     * @param $string
     */
    public function analyze($string)
    {
        $this->_data['useragent'] = $string;
        $classList = array("os", "browser");
        foreach ($classList as $value) {
            $class = "useragent_detect_" . $value;

            //$this->_data[$value] = $class::analyze($string);
            $this->_data[$value] = call_user_func($class . '::analyze', $string);
            $this->_data[$value]['image'] = $this->_makeImage($value, $this->_data[$value]['code']);
        }
        $this->_makePlatform();
    }
}