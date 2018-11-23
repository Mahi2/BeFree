<?php
namespace Befree;

use Befree\Database\DatabaseInterface;

/**
 * Class Repository
 * @package Befree
 */
class Repository
{
    /**
     * the repository table name in database
     * @var string
     */
    private $table;


    /**
     * the entity class
     * @var mixed
     */
    protected $entity;

    /**
     * the prefix of tables
     * @var string
     */
    protected $prefix;


    /**
     * database connexion
     * @var DatabaseInterface
     */
    private $db;


    /**
     * Repository constructor.
     * @param DatabaseInterface $database
     * @param string $prefix
     */
    public function __construct(DatabaseInterface $database, string $prefix)
    {
        $this->prefix = $prefix;
        $this->db = $database;
    }


    /**
     * @param string $statement
     * @param array $data
     * @param bool $entity
     * @param bool $fetchAll
     * @return mixed
     */
    final protected function query(string $statement, array $data = [], bool $entity = true, bool $fetchAll = true)
    {
        $entity = ($entity) ? $this->entity ?? null : null;
        return (empty($data)) ?
            $this->db->query($statement, $entity, $fetchAll) :
            $this->db->prepare($statement, $data, $entity, $fetchAll);
    }


    /**
     * save data in the database
     * @param array $data
     * @param bool $created_at
     * @return mixed
     */
    public function create(array $data, $created_at = false)
    {
        $fields = [];
        $values = [];
        foreach ($data as $key => $value) {
            $fields[] = "{$this->table}.{$key} = ?";
            $values[] = "{$value}";
        }
        $fields = implode(', ', $fields);

        if ($created_at) {
            return $this->query("INSERT INTO {$this->table} SET {$fields}, created_at = NOW()", $values);
        }
        return $this->query("INSERT INTO {$this->table} SET {$fields}", $values);
    }


    /**
     * update data
     * @param int $id
     * @param array $data
     * @param bool $updated_at
     * @return mixed
     */
    public function update(int $id, array $data, $updated_at = false)
    {
        $fields = [];
        $values = [];
        foreach ($data as $key => $value) {
            $fields[] = "{$key} = ?";
            $values[] = "{$value}";
        }
        $fields = implode(', ', $fields);
        $values[] = $id;

        if ($updated_at) {
            return $this->query("UPDATE {$this->table} SET {$fields}, updated_at = NOW() WHERE id = ?", $values);
        }
        return $this->query("UPDATE {$this->table} SET {$fields} WHERE id = ?", $values);
    }


    /**
     * delete a data in the storage
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        return $this->query("DELETE FROM {$this->table} WHERE {$this->table}.id = ?", [$id]);
    }


    /**
     * @return mixed
     */
    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->prefix . $this->table;
    }


    /**
     * get all data of a database table
     * @return mixed
     */
    public function all()
    {
        return $this->query("SELECT * FROM {$this->getTable()}");
    }
}
