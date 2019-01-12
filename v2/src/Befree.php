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

namespace Befree;

use Befree\Services\ErrorHandlerService;
use DI\ContainerBuilder;
use Exception;
use Befree\Router\RouterAwareTrait;
use Psr\Container\ContainerInterface;

/**
 * Class Befree
 * @package Befree
 */
class Befree
{

    /**
     * Request and redirect handler
     */
    use RouterAwareTrait;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * configuration for the container
     * @var string
     */
    private $config;


    /**
     * Befree constructor.
     * @param string $config
     */
    public function __construct(string $config)
    {
        $this->config = $config;
        $this->container = $this->getContainer();
    }


    /**
     * @return ContainerBuilder|ContainerInterface
     */
    public function getContainer()
    {
        if (is_null($this->container)) {
            $container = new ContainerBuilder();
            $container->addDefinitions($this->config);
            $this->container =  $container->build();
            return $this->container;
        }
        return $this->container;
    }


    /**
     * the user configuration file
     *
     * @var string
     */
    private $databaseConfigFile = ROOT . '/config.php';


    /**
     * whether befree has been install by the user
     * @return boolean
     */
    public function isInstalled(): bool
    {
        return file_exists($this->databaseConfigFile);
    }


    /**
     * run the befree application
     */
    public function run()
    {
        $route = ($this->getRouter())->run();
        if ($route) {
            if (is_string($route->getController())) {
                $action = explode('@', $route->getController());
                $method = $action[1] ?? 'index';
                $controller = $this->container->get($this->getAction($action[0]));
                call_user_func_array([$controller, $method], $route->getMatches());
                exit();
            }
            call_user_func_array($route->getController(), $route->getMatches());
            exit();
        } else {
            http_response_code(404);
        }
    }


    /**
     * @return string
     */
    public function getDatabaseConfigFile(): string
    {
        return $this->databaseConfigFile;
    }

    /**
     * @param string $databaseConfigFile
     */
    public function setDatabaseConfigFile(string $databaseConfigFile)
    {
        $this->databaseConfigFile = $databaseConfigFile;
    }



    /**
     * @param bool $active
     */
    public function errorHandler(bool $active = true)
    {
        if ($active) {
            $errorHandler = $this->container->get(ErrorHandlerService::class);
            $errorHandler->catch();
        }
    }


    /**
     * @param string $name
     * @return string
     */
    private function getAction(string $name)
    {
        $namespace = __NAMESPACE__ . "\\Application\\Controllers\\";
        $controller = $namespace . ucfirst($name) . 'Controller';
        return $controller;
    }
}
