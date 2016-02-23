<?php

namespace App\Models;

use App\Components\AbstractModel;
use App\Components\DB;
use App\Components\ModelException;

class ProductModel extends AbstractModel
{
    protected static $table = 'product';
    protected static $column1 = 'status';
    protected static $column2 = 'id';

    public static function getRecommended()
    {
        $class = get_called_class();

        $sql  = "SELECT * ";
        $sql .= "FROM product ";
        $sql .= "WHERE is_recommended = 1 ";
        $sql .= "ORDER BY id DESC";

        $db = new DB;
        $db->setClassName($class);
        $result = $db->query($sql);
        if ($result) {
            return $result;
        } else {
            throw new ModelException('Ошибка базы данных');
        }
    }
}