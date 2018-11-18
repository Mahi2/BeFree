<?php
namespace Befree;

/**
 * Class Befree
 * @package Befree
 */
class Befree
{

    /**
     * befree version
     * @var float
     */
    private $version = 2.0;

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
            header("Location: install", true, 403);
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