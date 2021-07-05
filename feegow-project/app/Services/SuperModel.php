<?php
namespace App\Services;

use App\Services\DB;
use Cake\Database\Query;
use Cake\Database\StatementInterface;

abstract class SuperModel
{
    /** @var string $table */
    protected $table;

    /** @var string $primaryKey */
    protected $primaryKey = "id";

    /** @var array $data */
    private $data;

    public function __set($name, $value)
    {
        $this->data[trim($name)] = $value;
    }

    /**
     * @return StatementInterface
     */
    public function save(): StatementInterface
    {
        return $this->create($this->data);
    }

    /**
     * @param array $data
     * @param array $types
     * @return StatementInterface
     */
    public function create(array $data, array $types = []): StatementInterface
    {
        return DB::instance()->insert($this->table, $data, $types);
    }

    /**
     * @param array $data
     * @param array $conditions
     * @param array $types
     * @return StatementInterface
     */
    public function update(array $data, array $conditions, array $types = []): StatementInterface
    {
        return DB::instance()->update($this->table, $data, $conditions, $types);
    }

    /**
     * @param array $conditions
     * @param array $types
     * @return StatementInterface
     */
    public function delete(array $conditions, array $types = []): StatementInterface
    {
        return DB::instance()->delete($this->table, $conditions, $types);
    }

    /**
     * @param mixed $id
     * @param array $data
     * @return StatementInterface
     */
    public function findByIdAndUpdate($id, array $data): StatementInterface
    {
        return $this->update($data, [$this->primaryKey => $id]);
    }

    /**
     * @param mixed $id
     * @return StatementInterface
     */
    public function findByIdAndDelete($id): StatementInterface
    {
        return $this->delete([$this->primaryKey => $id]);
    }

    /**
     * @return Query
     */
    public function query(): Query
    {
        return DB::instance()->newQuery()->from($this->table);
    }
}
