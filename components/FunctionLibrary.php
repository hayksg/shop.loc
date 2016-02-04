<?php

namespace App\Components;


class FunctionLibrary
{
    public static function clearStr($value)
    {
        return trim(strip_tags($value));
    }

    public static function clearInt($value)
    {
        return abs((int)$value);
    }

    public static function isName($name)
    {
        return (strlen($name) > 0) ? true : false;
    }

    public static function isPassword($password)
    {
        return (strlen($password) > 5) ? true : false;
    }

    public static function isEmail($email)
    {
        return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false;
    }

    public static function redirectTo($location = false)
    {
        if ($location) {
            header("Location: $location");
            exit;
        }
    }

    public static function deleteLink()
    {
        if (is_file(ROOT . '/logs/log.txt')) {
            unlink(ROOT . '/logs/log.txt');
        }
    }

    public static function getYear($date)
    {
        return ($date > 2016) ? '2016 - ' . $date : $date;
    }

    public static function buildPagination($total, $page, $limit, $index)
    {
        if ($total > $limit) {
            if ($page && $page <= ceil($total / $limit)) {
                return new Pagination($total, $page, $limit, $index);
            } else {
                self::redirectTo("/");
            }
        }
    }

}