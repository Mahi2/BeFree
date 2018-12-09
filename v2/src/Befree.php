<?php
namespace Befree;

use Befree\Services\ErrorHandlerService;
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
     * Befree constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
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
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }


    /**
     * @param bool $active
     */
    public function errorHandler(bool $active = true)
    {
        $errorHandler = $this->container->get(ErrorHandlerService::class);
        if ($active) {
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
