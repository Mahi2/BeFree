<?php

namespace Befree\Database;

use \PDO;

/**
 * Interface DatabaseInterface
 * @package Befree\Database
 */
interface DatabaseInterface
{

    /**
     * DatabaseInterface constructor.
     * @param string $dbname
     * @param string $host
     * @param string $username
     * @param string $password
     */
    public function __construct(string $dbname, string $host, string $username, string $password);


    /**
     * @return PDO
     */
    public function getPdo(): PDO;


    /**
     * @param $statement
     * @param $entity
     * @param $fetchAll
     * @return mixed
     */
    public function query($statement, $entity, $fetchAll);


    /**
     * @param $statement
     * @param $data
     * @param $entity
     * @param $fetchAll
     * @return mixed
     */
    public function prepare($statement, $data, $entity, $fetchAll);


    /**
     * @return mixed
     */
    public function lastInsertId();
}
