<?php

namespace App\Components;

class Cookie
{
    public static function deleteCookie($key)
    {
        if (isset($_COOKIE[$key])) {
            setcookie('user', '', time() - 3600, '/');
        }
    }
}