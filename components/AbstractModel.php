<?php
namespace App\Components;

use App\Components\FunctionLibrary as FL;
use App\Components\Session;

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

    public static function getAllUsingColumns($desc = false, $limit = 0, $page = 0)
    {
        $class = get_called_class();

        $page = intval($page);
        $offset = ($page - 1) * $limit;

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
        if ($offset > 0) {
            $sql .= " OFFSET {$offset}";
        }

        $db = new DB;
        $db->setClassName($class);
        $result = $db->query($sql);

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public static function checkRegister($email, $password, $remember = '')
    {
        $user = self::getByColumn('email', $email);

        if ($user) {
            if (password_verify($password, $user->password)) {
                if ($remember == 'true') {
                    $key = 'avtobus12troleibus23h23';
                    $encrypted = FL::encrypted($email, $key);
                    setcookie('user', $encrypted, 0x7FFFFFFF, '/');
                }
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
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

    public static function getByCategoryId($categoryId, $limit = 0, $page, $status = 0)
    {
        $class = get_called_class();

        $page = intval($page);
        $offset = ($page - 1) * $limit;

        $sql  = "SELECT * ";
        $sql .= "FROM ";
        $sql .= static::$table;
        $sql .= " WHERE category_id = :category_id ";
        if ($status) {
            $sql .= "AND status = 1 ";
        }
        $sql .= "ORDER BY id DESC";
        if ($limit) {
            $sql .= " LIMIT {$limit}";
        }
        if ($offset > 0) {
            $sql .= " OFFSET {$offset}";
        }

        $db = new DB;
        $db->setClassName($class);
        $result = $db->query($sql, [':category_id' => $categoryId]);

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public static function getTotal($column = false, $value = false)
    {
        $class = get_called_class();

        $sql  = "SELECT COUNT(id) ";
        $sql .= "AS count ";
        $sql .= "FROM ";
        $sql .= static::$table;
        if ($column && $value) {
            $sql .= " WHERE ";
            $sql .= $column . ' = :' . $column;
        }
        $sql .= " LIMIT 1";


        $db = new DB;
        $db->setClassName($class);
        $result = $db->query($sql, [':' . $column => $value]);

        if ($result) {
            return $result[0]->count;
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
            return false;
        }
    }

    protected function insert($rememberUser)
    {
        if (isset($this->data['password'])) {
            $password = $this->data['password'];
            $password = password_hash($password, PASSWORD_DEFAULT);
            $this->data['password'] = $password;
        }

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
            if ($rememberUser) {
                // Вход с помощью сессии
                // $user = self::getByColumn('email', $this->data['email']);
                // Session::createSession('user', $user);

                // Вход с помощью cookie
                $key = 'avtobus12troleibus23h23';
                $encrypted = FL::encrypted($this->data['email'], $key);
                setcookie('user', $encrypted, 0x7FFFFFFF, '/');
            }
            return $db->lastInsertId();
        } else {
            throw new ModelException('Произошла ошибка при добавлении');
        }
    }

    protected function update($newDate, $rememberUser)
    {
        $arr = [];
        $params = [];

        if (isset($this->data['password'])) {
            $password = $this->data['password'];
            $password = password_hash($password, PASSWORD_DEFAULT);
            $this->data['password'] = $password;
        }

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
            if ($rememberUser) {
                // Вход с помощью сессии
                // $user = self::getByColumn('email', $this->data['email']);
                // Session::createSession('user', $user);

                // Вход с помощью cookie
                $key = 'avtobus12troleibus23h23';
                $encrypted = FL::encrypted($this->data['email'], $key);
                setcookie('user', $encrypted, 0x7FFFFFFF, '/');
            }
            return $result;
        } else {
            throw new ModelException('Произошла ошибка при редактировании');
        }
    }

    public function save($newDate = false, $rememberUser = false)
    {
        if (isset($this->id)) {
            return $this->update($newDate, $rememberUser);
        } else {
            return $this->insert($rememberUser);
        }
    }

    public function delete()
    {
        $sql  = "DELETE FROM ";
        $sql .= static::$table;
        $sql .= " WHERE id = :id ";
        $sql .= "LIMIT 1";

        $db = new DB;
        $result = $db->execute($sql, [':id' => $this->data['id']]);

        if ($result) {
            return $result;
        } else {
            throw new ModelException('Произошла ошибка при удалении');
        }
    }
}