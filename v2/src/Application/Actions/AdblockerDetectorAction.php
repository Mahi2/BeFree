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

use Befree\Repositories\AdblockerSettingsRepository;
use DI\Container;

/**
 * Class AdblockerDetectorAction
 * @package Befree\Applications\Actions
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
