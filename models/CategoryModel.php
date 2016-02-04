<?php

namespace App\Models;

use App\Components\AbstractModel;

/**
 * Class CategoryModel
 *
 * @property $name,
 * @property $sort_order,
 * @property $status,
 */

class CategoryModel extends AbstractModel
{
    protected static $table = 'category';
    protected static $column1 = 'status';
    protected static $column2 = 'sort_order';
}