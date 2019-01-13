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


namespace Befree\Application\Controllers\Tools;


use Befree\Application\Controllers\Controller;
use Befree\Http\Request;
use Befree\Http\RequestAwareTrait;
use Cake\Core\Exception\Exception;
use Psr\Container\ContainerInterface;
use Twig\Error\Error;

/**
 * Class PortScannerController
 * @package Befree\Application\Controllers\Tools
 */
class PortScannerController extends Controller
{

    use RequestAwareTrait;

    /**
     * @var array
     */
    private $ports = [
        20,
        21,
        22,
        23,
        25,
        53,
        80,
        110,
        119,
        135,
        137,
        138,
        139,
        143,
        443,
        520,
        1433,
        1434,
        1723,
        2082,
        2086,
        2095,
        3306,
        8080
    ];

    /**
     * @var array
     */
    private $results = [];


    /**
     * Show opened port on the server
     */
    public function index()
    {
        $results = [];
        $ipDomain = $this->request->input('ipdomain');

        if ($this->request->isPost()) {
            foreach ($this->ports as $key => $port) {
                $pf = @fsockopen($ipDomain, $port, $errno, $errstr, 3);
                if ($pf) {
                    $results[$port] = true;
                    fclose($pf);
                } else {
                    $results[$port] = false;
                }
            }
        }

        $this->render('port-scanner', compact('ipDomain', 'results'));
    }
}