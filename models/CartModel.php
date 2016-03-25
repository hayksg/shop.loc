<?php

namespace App\Models;

use App\Components\AbstractModel;

class CartModel extends AbstractModel
{
    protected static $table = 'product_order';

    public static function addProduct($id)
    {
        $products = array();

        if (isset($_SESSION['products'])) {
            $products = $_SESSION['products'];
        }

        if (!array_key_exists($id, $products)) {
            $products[$id] = 1;
        } else {
            $products[$id]++;
        }

        $_SESSION['products'] = $products;

        return self::countProductsInCart();
    }

    public static function countProductsInCart()
    {
        if (isset($_SESSION['products'])) {
            $result = 0;
            foreach ($_SESSION['products'] as $value) {
                $result += $value;
            }
            return $result;
        } else {
            return 0;
        }
    }
}