<?php

namespace App\Models;

use App\Components\AbstractModel;
use App\Components\FunctionLibrary as FL;

/**
 * Class UserModel
 * @property $name,
 * @property $email,
 * @property $password,
 */

class UserModel extends AbstractModel
{
    protected static $table = 'user';

    public static function getUser($key)
    {
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];
            return unserialize($value);
        } elseif (isset($_COOKIE[$key])) {
            $str = 'avtobus12troleibus23h23';
            $encrypted = $_COOKIE[$key];
            $email = FL::decrypted($encrypted, $str);
            return UserModel::getByColumn('email', $email);
        } else {
            FL::redirectTo('/');
        }
    }

    public static function isUser($key)
    {
        if ((isset($_SESSION[$key]) && !empty($_SESSION[$key])) || isset($_COOKIE[$key])) {
            return true;
        } else {
            return false;
        }
    }
}