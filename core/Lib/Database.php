<?php
namespace Core\Lib;

use Core\Lib\Config;

class Database extends MRObject
{
    private $conn;
    private $select;
    private $where;
    private $inner;
    private $left;
    private $order;
    private $group;
    private $query;
    public function __construct()
    {
        $db = config()->get('database');
        $dns = "mysql:host={$db->host};dbname={$db->dbname};";
        $this->conn = new \PDO($dns, $db->username, $db->password);
    }

    private function fetch()
    {
        $this->query = trim("{$this->select} {$this->where} {$this->inner} {$this->left} {$this->order} {$this->group}");
        $this->state = $this->conn->prepare($this->query);
        $this->state->execute();
        while ($res = $this->state->fetch(\PDO::FETCH_ASSOC) !== false) {
            $this->data[$res->id] = $res;
        }
    }

    public function where($where)
    {
        $this->where .="WHERE {$where}";
        return $this;
    }

    public function inner($table, $on)
    {
        $this->inner .="INNER JOIN {$table} ON {$on}";
        return $this;
    }

    public function left($table, $on)
    {
        $this->inner .= "LEFT JOIN {$table} ON {$on}";
        return $this;
    }
}
