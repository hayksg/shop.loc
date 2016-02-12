<?php

namespace App\Models;

class CartModel
{
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

    public static function amountProductsPriceInCart($productsKeysArray, $products)
    {
        if (is_array($productsKeysArray) && is_array($products)) {
            $price = 0;
            foreach ($products as $product) {
                if (array_key_exists($product->id, $productsKeysArray)) {
                    $price += $productsKeysArray[$product->id] * $product->price;
                } else {
                    return false;
                }
            }
            return $price;
        }
    }
}