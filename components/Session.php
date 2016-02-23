<?php

namespace App\Components;

class Session
{
    public static function getSession($sessionName, $delete = false)
    {
        if (isset($_SESSION[$sessionName])) {
            $result =  $_SESSION[$sessionName];
            if ($delete) {
                self::deleteSession($sessionName);
            }

            return $result;
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

    public static function createSession($key, $value, $serialize = false)
    {
        if ($serialize) {
            $value = serialize($value);
            $_SESSION[$key] = $value;
        } else {
            $_SESSION[$key] = $value;
        }
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