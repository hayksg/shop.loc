<?php

namespace App\Models;

use App\Components\AbstractModel;

class CategoryModel extends AbstractModel
{
    protected static $table = 'category';
    protected static $column1 = 'status';
    protected static $column2 = 'sort_order';
}