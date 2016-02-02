<?php
namespace App\Components;

abstract class AbstractModel
{
    protected static $table;
    protected static $column1;
    protected static $column2;
    protected $data;

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __get($key)
    {
        return $this->data[$key];
    }

    public function __isset($key)
    {
        return isset($this->data[$key]);
    }

    public static function getAll()
    {
        $class = get_called_class();

        $sql  = "SELECT * ";
        $sql .= "FROM ";
        $sql .= static::$table;
        $sql .= " ORDER BY id DESC";

        $db = new DB;
        $db->setClassName($class);
        $result = $db->query($sql);
        if ($result) {
            return $result;
        } else {
            throw new ModelException('Ошибка базы данных');
        }
    }

    public static function getAllUsingColumns($desc = false, $limit = 0)
    {
        $class = get_called_class();

        $sql  = "SELECT * ";
        $sql .= "FROM ";
        $sql .= static::$table;
        $sql .= " WHERE ";
        $sql .= static::$column1;
        $sql .= " = 1";
        $sql .= " ORDER BY ";
        $sql .= static::$column2;
        if ($desc) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }
        if ($limit) {
            $sql .= " LIMIT {$limit}";
        }

        $db = new DB;
        $db->setClassName($class);
        $result = $db->query($sql);

        if ($result) {
            return $result;
        } else {
            throw new ModelException('Ошибка базы данных');
        }
    }

    public static function getById($id)
    {
        $class = get_called_class();

        $sql  = "SELECT * ";
        $sql .= "FROM ";
        $sql .= static::$table;
        $sql .= " WHERE id = :id ";
        $sql .= "LIMIT 1";

        $db = new DB;
        $db->setClassName($class);
        $result = $db->query($sql, [':id' => $id]);

        if ($result) {
            return $result[0];
        } else {
            throw new ModelException('Ошибка базы данных');
        }
    }

    public static function getByColumn($column, $value)
    {
        $class = get_called_class();

        $sql  = "SELECT * ";
        $sql .= "FROM ";
        $sql .= static::$table;
        $sql .= " WHERE ";
        $sql .= $column;
        $sql .= " = :value ";
        $sql .= "LIMIT 1";

        $db = new DB;
        $db->setClassName($class);
        $result = $db->query($sql, [':value' => $value]);

        if ($result) {
            return $result[0];
        } else {
            throw new ModelException('Ошибка базы данных');
        }
    }

    protected function insert()
    {
        $params = [];
        $keys = array_keys($this->data);

        foreach ($this->data as $key => $value) {
            $params[':' . $key] = $value;
        }

        $sql  = "INSERT INTO ";
        $sql .= static::$table;
        $sql .= "(" . implode(', ', $keys) . ")";
        $sql .= " VALUES";
        $sql .= "(" . implode(', ', array_keys($params)) . ")";

        $db = new DB;
        $result = $db->execute($sql, $params);

        if ($result) {
            return $db->lastInsertId();
        } else {
            throw new ModelException('Ошибка базы данных');
        }
    }

    protected function update($newDate)
    {
        $arr = [];
        $params = [];

        foreach ($this->data as $key => $value) {
            $params[':' . $key] = $value;
            if ($key == 'id') { continue; }
            $arr[] = $key . ' = :' . $key;
        }

        if ($newDate) {
            $params[':date'] = date("Y-m-d H:i:s");
        }

        $sql  = "UPDATE ";
        $sql .= static::$table;
        $sql .= " SET ";
        $sql .= implode(', ', $arr);
        $sql .= " WHERE id = :id ";
        $sql .= "LIMIT 1";

        $db = new DB;
        $result = $db->execute($sql, $params);

        if ($result) {
            return $result;
        } else {
            throw new ModelException('Ошибка базы данных');
        }
    }

    public function save($newDate = false)
    {
        if (isset($this->id)) {
            return $this->update($newDate);
        } else {
            return $this->insert();
        }
    }
}