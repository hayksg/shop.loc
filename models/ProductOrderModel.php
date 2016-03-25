<?php

namespace App\Models;

use App\Components\AbstractModel;

class ProductOrderModel extends AbstractModel
{
    protected static $table = 'product_order';

    public static function countProductsInOrder($arrayOrder)
    {
        if (!empty($arrayOrder) && is_array($arrayOrder)) {
            $result = 0;
            foreach ($arrayOrder as $value) {
                $result += $value;
            }
            return $result;
        } else {
            return 0;
        }
    }
}