<?php

use App\Components\Router;
use App\Components\View;
use App\Components\Logger;
use App\Components\FunctionLibrary as FL;

// Front Controller

// 1. Общие настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

// 2. Подключение системных файлов
define('ROOT', dirname(__FILE__));
require_once(ROOT . '/components/autoload.php');

// 3. Вызов Router
try {
    $router = new Router;
    $router->run();
    FL::deleteLink();
} catch (Exception $e) {
    $logger = Logger::getInstance();
    $logger->setLog($e->getFile(), $e->getLine(), $e->getMessage());

    $view = new View;
    $view->error = $e->getMessage();
    $view->display('error.php');
}