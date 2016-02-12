<?php

namespace App\Controllers;

use App\Components\View;
use App\Components\Session;
use App\Components\Cookie;
use App\Components\FunctionLibrary as FL;
use App\Models\CategoryModel;
use App\Models\UserModel;

class CabinetController
{
    public function actionIndex()
    {
        $categories = CategoryModel::getAllUsingColumns();

        $user = UserModel::getUser('user');

        $view = new View;
        $view->categories = $categories;
        $view->user = $user;
        $view->display('cabinet/index.php');

        return true;
    }

    public function actionEdit($id)
    {
        $id = (int)$id;
        $name     = '';
        $password = '';
        $errors   = [];

        $user = UserModel::getUser('user');

        $categories = CategoryModel::getAllUsingColumns();

        if (isset($_POST['submit'])) {
            $name     = FL::clearStr($_POST['name']);
            $password = FL::clearStr($_POST['password']);

            if (!FL::isName($name)) {
                $errors[] = 'Имя не может быть пустым';
            }

            if (!FL::isPassword($password)) {
                $errors[] = 'Пароль должен быть больше 5 символов';
            }

            if (empty($errors)) {
                $user = UserModel::getById($id);
                $user->name = $name;
                $user->password = $password;
                Session::deleteSession('user');
                Cookie::deleteCookie('user');
                $result = $user->save(false, true);
                if ($result) {
                    FL::redirectTo('/cabinet');
                }
            }
        }

        $view = new View;
        $view->categories = $categories;
        $view->id         = $id;
        $view->errors     = $errors;
        $view->password     = $password;
        $view->user       = $user;
        $view->display('cabinet/edit.php');


        return true;
    }

}