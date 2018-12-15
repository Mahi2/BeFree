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
    public function query(string $statement, ?string $entity, bool $fetchAll);


    /**
     * @param $statement
     * @param $data
     * @param $entity
     * @param $fetchAll
     * @return mixed
     */
    public function prepare(string $statement, array $data, ?string $entity, bool $fetchAll);


    /**
     * @return mixed
     */
    public function lastInsertId();
}
