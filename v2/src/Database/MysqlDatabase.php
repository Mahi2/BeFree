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

use Befree\Services\ErrorHandlerService;
use PDO;
use PDOException;

/**
 * Class MysqlDatabase
 * @package Befree\Database
 */
class MysqlDatabase implements DatabaseInterface
{
    private $pdo;

    /**
     * construction
     *
     * @param string $dbname
     * @param string $host
     * @param string $username
     * @param string $password
     */
    public function __construct(string $dbname, string $host, string $username, string $password)
    {
        try {
            $this->pdo = new PDO(
                "mysql:Host={$host};dbname={$dbname};charset=utf8",
                $username,
                $password
            );

            $this->pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        } catch (PDOException $e) {
            ErrorHandlerService::throw($e);
        }
    }


    /**
     * renvoi une instance de pdo
     *
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }


    /**
     * @return mixed
     */
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }


    /**
     * tells if the query needs to fetch data
     * @param string $statement
     * @return boolean
     */
    private function needsFetch(string $statement): bool
    {
        $statement = trim($statement);
        switch ($statement) {
            case strpos($statement, 'INSERT') === 0:
                return false;
                break;
            case strpos($statement, 'UPDATE') === 0:
                return false;
                break;
            case strpos($statement, 'DELETE') === 0:
                return false;
                break;
            default:
                return true;
                break;
        }
    }


    /**
     * @param string $statement
     * @param array $data
     * @param string $entity
     * @param boolean $fetchAll
     * @return array|mixed|\PDOStatement
     */
    public function prepare(string $statement, array $data, ?string $entity = null, bool $fetchAll = true)
    {
        try {
            $req = $this->pdo->prepare($statement);
            $req->execute($data);

            if ($this->needsFetch($statement)) {
                (is_null($entity)) ?
                    $req->setFetchMode(PDO::FETCH_OBJ) :
                    $req->setFetchMode(PDO::FETCH_CLASS, $entity);

                return ($fetchAll) ? $req->fetchAll() : $req->fetch();
            } else {
                return $req;
            }
        } catch (PDOException $e) {
            ErrorHandlerService::throw($e);
        }
    }


    /**
     * @param string $statement
     * @param string $entity
     * @param boolean $fetchAll
     * @return array|mixed|\PDOStatement
     */
    public function query(string $statement, ?string $entity, bool $fetchAll)
    {
        try {
            $req = $this->pdo->query($statement);
            if ($this->needsFetch($statement)) {
                (is_null($entity)) ?
                    $req->setFetchMode(PDO::FETCH_OBJ) :
                    $req->setFetchMode(PDO::FETCH_CLASS, $entity);

                return ($fetchAll) ? $req->fetchAll() : $req->fetch();
            } else {
                return $req;
            }
        } catch (PDOException $e) {
            ErrorHandlerService::throw($e);
        }
    }
}
