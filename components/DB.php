<?php

namespace App\Components;

use \PDO;
use \PDOException;

class DB
{
    private $db;
    protected $className;

    public function __construct()
    {
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";

        $this->db = new PDO($dsn, $params['user'], $params['password']);
        $this->db->exec("SET NAMES 'utf-8'");
    }

    public function setClassName($className) {
        $this->className = $className;
    }

    public function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->className);
    }

    public function execute($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function lastInsertId() {
        return $this->db->lastInsertId();
    }
}