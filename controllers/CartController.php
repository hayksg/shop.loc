<?php

namespace App\Controllers;

use App\Components\View;
use App\Components\Session;
use App\Components\FunctionLibrary as FL;
use App\Models\CartModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class CartController
{
    public function actionIndex()
    {
        $categories  = [];
        $products    = [];
        $amountPrice = 0;

        $categories = CategoryModel::getAllUsingColumns();

        $productsKeysArray = Session::getSession('products');
        if ($productsKeysArray) {
            $keysArray  = array_keys($productsKeysArray);
            $keysString = implode(',', $keysArray);
            if ($keysString) {
                $products = ProductModel::getAll($keysString);
                $amountPrice = CartModel::amountProductsPriceInCart($productsKeysArray, $products);
            }
        }

        $view = new View;
        $view->categories = $categories;
        $view->products = $products;
        $view->amountPrice = $amountPrice;
        $view->display('cart/index.php');

        return true;
    }

    public function actionAdd($id)
    {
        $countProductsInCart = CartModel::addProduct($id);

        if ($countProductsInCart) {
            echo (int)$countProductsInCart;
        }
        return true;
    }

    public function actionAddProduct($id)
    {
        $countProductInCart = Session::getSessionValue('products', $id);

        if (isset($_POST['price'])) {
            $price = $_POST['price'];
            $amount = $price * $countProductInCart;
            echo "$countProductInCart|$amount";
        }
        return true;
    }

    public function actionDelete($id)
    {
        Session::deleteSessionValue('products', $id);
        FL::redirectTo('/cart');
        return true;
    }

    public function actionOrder()
    {
        $categories = CategoryModel::getAllUsingColumns();

        $view = new View;
        $view->categories = $categories;
        $view->display('cart/order.php');

        return true;
    }
}