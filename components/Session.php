<?php

namespace App\Components;

class Session
{
    public static function getSession($sessionName)
    {
        if (isset($_SESSION[$sessionName])) {
            return $_SESSION[$sessionName];
        } else {
            return false;
        }
    }

    public static function getSessionValue($sessionName, $key)
    {
        if (isset($_SESSION[$sessionName][$key])) {
            return $_SESSION[$sessionName][$key];
        } else {
            return 0;
        }
    }

    public static function createSession($key, $value)
    {
        $value = serialize($value);
        $_SESSION[$key] = $value;
    }

    public static function deleteSession($key)
    {
        if (isset($_SESSION[$key]) || empty($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function deleteSessionValue($sessionName, $key)
    {
        if (isset($_SESSION[$sessionName][$key])) {
            unset($_SESSION[$sessionName][$key]);
        }
    }
}