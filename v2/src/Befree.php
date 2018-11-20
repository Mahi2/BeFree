<?php
namespace Befree;

use Befree\Http\RequestAwareTrait;
use Befree\Router\RouterAwareTrait;
use Exception;
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
    private $databaseConfigFile = 'database.php';


    /**
     * whether befree has been install by the user
     */
    public function isInstalled()
    {
        if (!file_exists($this->databaseConfigFile)) {
            $this->redirect('install/index.php');
        }
    }


    /**
     * run the befree application
     */
    public function run ()
    {
        try {
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
        } catch (Exception $e) {
            var_dump($e);
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
}