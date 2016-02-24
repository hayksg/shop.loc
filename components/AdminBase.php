<?php

namespace App\Components;

use App\Models\UserModel;

abstract class AdminBase
{
    public function __construct()
    {
        $user = UserModel::getUser('user');
        if ($user) {
            if ($user->role == 'super_admin' || $user->role == 'admin') {
                return true;
            }
        }

        die('Access denied');
    }
}