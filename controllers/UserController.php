<?php

namespace App\Controllers;

use App\Components\View;
use App\Components\Session;
use App\Components\Cookie;
use App\Components\FunctionLibrary as FL;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\UserModel;

class UserController
{
    public function actionRegister()
    {
        $name     = '';
        $email    = '';
        $password = '';
        $result   = 0;
        $errors   = [];

        $categories = CategoryModel::getAllUsingColumns();

        if (isset($_POST['submit'])) {
            $name     = FL::clearStr($_POST['name']);
            $email    = FL::clearStr($_POST['email']);
            $password = FL::clearStr($_POST['password']);

            if (!FL::isName($name)) {
                $errors[] = 'Имя не может быть пустым';
            }

            if (!FL::isEmail($email)) {
                $errors[] = 'Некорректный email';
            }

            if (UserModel::getByColumn('email', $email)) {
                $errors[] = 'Такой email уже существует';
            }

            if (!FL::isPassword($password)) {
                $errors[] = 'Пароль должен быть больше 5 символов';
            }

            if (empty($errors)) {
                $user = new UserModel;
                $user->name     = $name;
                $user->email    = $email;
                $user->password = $password;
                $result = $user->save(false, true);
                if ($result) {
                    FL::redirectTo('/cabinet');
                }
            }
        }

        $view = new View;
        $view->categories = $categories;
        $view->errors     = $errors;
        $view->name       = $name;
        $view->email      = $email;
        $view->password   = $password;
        $view->result     = $result;
        $view->display('user/register.php');

        return true;
    }

    public function actionLogin()
    {
        $email    = '';
        $password = '';
        $remember = '';
        $errors   = [];

        if (isset($_POST['submit'])) {
            $email    = FL::clearStr($_POST['email']);
            $password = FL::clearStr($_POST['password']);
            if (isset($_POST['remember'])) {
                $remember = $_POST['remember'];
            }

            if (!FL::isEmail($email)) {
                $errors[] = 'Некорректный email';
            }

            if (!FL::isName($password)) {
                $errors[] = 'Пароль не может быть пустым';
            }

            if (empty($errors)) {
                $user = UserModel::checkRegister($email, $password, $remember);

                if ($user) {
                    Session::createSession('user', $user);

                    FL::redirectTo('/cabinet');
                } else {
                    $errors[] = 'Неправильные данные для входа на сайт';
                }
            }
        }

        $categories = CategoryModel::getAllUsingColumns();

        $view = new View;
        $view->categories = $categories;
        $view->email = $email;
        $view->password = $password;
        $view->errors = $errors;
        $view->display('user/login.php');

        return true;
    }

    public function actionLogout()
    {
        Session::deleteSession('user');
        Cookie::deleteCookie('user');
        FL::redirectTo('/');
    }
}