<?php

namespace App\Models;

use App\Components\AbstractModel;

class ProductModel extends AbstractModel
{
    protected static $table = 'product';
    protected static $column1 = 'status';
    protected static $column2 = 'id';
}