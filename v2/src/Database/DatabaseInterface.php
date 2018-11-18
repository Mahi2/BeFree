<?php

namespace Befree\Database;

use \PDO;

interface DatabaseInterface
{

    /**
     * construction
     *
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
}
