<?php

use App\Components\View;
use App\Components\FunctionLibrary as FL;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\UserModel;

class UserController
{
    public function actionLogin()
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
                $result = $user->save();
            }
        }

        $view = new View;
        $view->categories = $categories;
        $view->errors     = $errors;
        $view->name       = $name;
        $view->email      = $email;
        $view->password   = $password;
        $view->result     = $result;
        $view->display('user/login.php');

        return true;
    }
}