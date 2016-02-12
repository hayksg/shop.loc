<?php

function appAutoload($classPath)
{
    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

    $pathArray = explode('\\', $classPath);
    $className = array_pop($pathArray);
    $pathString = implode(DS, $pathArray);

    if ($pathString == 'App' . DS . 'Components') {
        $pathFile = ROOT . DS . 'components' . DS;
    } elseif ($pathString == 'App' . DS . 'Models') {
        $pathFile = ROOT . DS . 'models' . DS;
    } elseif ($pathString == 'App' . DS . 'Controllers') {
        $pathFile = ROOT . DS . 'controllers' . DS;
    }

    $file = $pathFile . $className . '.php';

    if (is_file($file)) {
        include_once($file);
    }
}

spl_autoload_register('appAutoload');