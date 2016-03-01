<?php

namespace App\Controllers;

use App\Components\AdminBase;
use App\Components\View;
use App\Components\FunctionLibrary as FL;
use App\Models\UserModel;

class AdminUserController extends AdminBase
{
    public function actionIndex()
    {
        $users = UserModel::getAllByColumn('role', 'admin');

        $view = new View();
        $view->users = $users;
        $view->display('admin_user/index.php');

        return true;
    }

    public function actionCreate()
    {
        $errors = [];

        if (isset($_POST['submit'])) {
            $name     = FL::clearStr($_POST['name']);
            $email    = FL::clearStr($_POST['email']);
            $password = FL::clearStr($_POST['password']);

            if (!FL::isValue($name)) {
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
                $user->role     = 'admin';
                $result = $user->save(false, true);
                if ($result) {
                    FL::redirectTo('/admin/user');
                }
            }
        }

        $view = new View();
        $view->errors = $errors;
        $view->display('admin_user/create.php');

        return true;
    }

    public function actionDelete($id)
    {
        UserModel::delete($id);
        FL::redirectTo('/admin/user');

        return true;
    }
}