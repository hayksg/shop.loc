<?php

namespace App\Components;

class Session
{
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
}