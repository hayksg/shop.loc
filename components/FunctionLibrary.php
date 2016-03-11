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

    public static function isValue($name)
    {
        return (strlen($name) > 0) ? true : false;
    }

    public static function isPassword($password)
    {
        return (strlen($password) > 5) ? true : false;
    }

    public static function isPhone($phone)
    {
        if (preg_match("/^[+]{1}[0-9 ]+$/", $phone)) {
            return true;
        } else {
            return false;
        }
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

    public static function encrypted($string, $key)
    {
        $iv = mcrypt_create_iv(
            mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC),
            MCRYPT_DEV_URANDOM
        );

        $encrypted = base64_encode(
            $iv .
            mcrypt_encrypt(
                MCRYPT_RIJNDAEL_128,
                hash('sha256', $key, true),
                $string,
                MCRYPT_MODE_CBC,
                $iv
            )
        );

        return $encrypted;
    }

    public static function decrypted($encrypted, $key)
    {
        $data = base64_decode($encrypted);
        $iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));

        $decrypted = rtrim(
            mcrypt_decrypt(
                MCRYPT_RIJNDAEL_128,
                hash('sha256', $key, true),
                substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)),
                MCRYPT_MODE_CBC,
                $iv
            ),
            "\0"
        );

        return $decrypted;
    }

    public static function getDate($dateValue, $timeValue = false)
    {
        $dt = new \DateTime($dateValue);
        if ($timeValue) {
            $dateString = $dt->format('d,F,Y,H,i,s');
        } else {
            $dateString = $dt->format('d,F,Y');
        }

        $dateArray = explode(',', $dateString);

        switch ($dateArray[1]) {
            case 'January':
                $month = 'Января';
                break;
            case 'February':
                $month = 'Февраля';
                break;
            case 'March':
                $month = 'Марта';
                break;
            case 'April':
                $month = 'Апреля';
                break;
            case 'May':
                $month = 'Мая';
                break;
            case 'June':
                $month = 'Июня';
                break;
            case 'July':
                $month = 'Июля';
                break;
            case 'August':
                $month = 'Августа';
                break;
            case 'September':
                $month = 'Сентября';
                break;
            case 'October':
                $month = 'Октября';
                break;
            case 'November':
                $month = 'Ноября';
                break;
            case 'December':
                $month = 'Декабря';
                break;
        }

        $result = $dateArray[0] . ' ' . $month . ' ' . $dateArray[2];

        if ($timeValue) {
            $output = $result . ' ' . $dateArray[3] . ':' . $dateArray[4] . ':' . $dateArray[5];
        } else {
            $output = $result;
        }

        return self::clearStr($output);
    }

    public static function fileGetContents($path)
    {
        $filePath = ROOT . '/config/' . $path;
        if (is_file($filePath)) {
            return file_get_contents($filePath);
        }
    }

    public static function getStatus($value)
    {
        $output = '';

        if ($value) {
            switch ($value) {
                case 1:
                    $output = 'Новый заказ';
                    break;
                case 2:
                    $output = 'В обработке';
                    break;
                case 3:
                    $output = 'Доставляется';
                    break;
                case 4:
                    $output = 'Доставлен';
                    break;
                default:
                    $output = 'Такого статуса нет';
                    break;
            }
        }

        return $output;
    }
}