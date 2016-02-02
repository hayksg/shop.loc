<?php

namespace App\Components;


class Logger
{
    const LOG_NAME = ROOT . '/logs/log.txt';
    protected static $instance = null;

    private function __construct(){}

    private function __clone(){}

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function setLog($file, $line, $message)
    {
        $str = $file . '|' . $line . '|' . $message;
        file_put_contents(self::LOG_NAME, $str);
    }

    public function getLog()
    {
        if (is_file(self::LOG_NAME)) {
            $str = file_get_contents(self::LOG_NAME);

            $segments = explode('|', $str);
            $output = 'Имя файла: ' . $segments[0] . '<br>' .
                      'Линия ошибки: ' . $segments[1] . '<br>' .
                      'Сообщение: ' . $segments[2] . '<br>';

            return $output;
        }

    }

    public function deleteLog()
    {
        if (is_file(self::LOG_NAME)) {
            unlink(self::LOG_NAME);
        }
    }
}