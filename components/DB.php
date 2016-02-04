<?php

namespace App\Components;

use \PDO;
use \PDOException;
use App\Components\View;

class DB
{
    private $db;
    protected $className;

    public function __construct()
    {
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";

        try {
            $this->db = new PDO($dsn, $params['user'], $params['password']);
            $this->db->exec("SET NAMES 'utf-8'");
        } catch (PDOException $e) {
            $logger = Logger::getInstance();
            $logger->setLog($e->getFile(), $e->getLine(), $e->getMessage());

            $view = new View;
            $view->error = "Нет соединения с БД";
            $view->display('error.php');
            die;
        }
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