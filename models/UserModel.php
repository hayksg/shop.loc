<?php

namespace App\Models;

use App\Components\AbstractModel;

/**
 * Class UserModel
 * @property $name,
 * @property $email,
 * @property $password,
 */

class UserModel extends AbstractModel
{
    protected static $table = 'user';
}