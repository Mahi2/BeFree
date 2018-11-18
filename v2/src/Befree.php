<?php
namespace Befree;

use Befree\Http\RequestAwareTrait;
use Befree\Router\RouterAwareTrait;

/**
 * Class Befree
 * @package Befree
 */
class Befree
{

    /**
     * Request and redirect handler
     */
    use RequestAwareTrait, RouterAwareTrait;


    /**
     * befree version
     * @var float
     */
    private $version = VERSION;

    /**
     * the user configuration file
     *
     * @var string
     */
    private $databaseConfigFile = 'config.php';


    /**
     * whether befree has been install by the user
     */
    public function isInstalled()
    {
        if (!is_file($this->databaseConfigFile)) {
            $this->redirect('install');
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
}