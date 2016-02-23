<?php

namespace App\Controllers;

use App\Components\View;
use App\Components\Session;
use App\Components\FunctionLibrary as FL;
use App\Models\CartModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\UserModel;

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
        $userName = '';
        $errors   = [];

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

        $user = UserModel::getUser('user');
        if ($user) {
            $userName = $user->name;
            $userId = $user->id;
        } else {
            $userId = 0;
        }

        if (isset($_POST['submit'])) {
            $name    = FL::clearStr($_POST['name']);
            $phone   = FL::clearStr($_POST['phone']);
            $comment = FL::clearStr($_POST['comment']);

            if (!FL::isValue($name)) {
                $errors[] = 'Имя не может быть пустым';
            }

            if (!FL::isValue($phone)) {
                $errors[] = 'Телефон не может быть пустым';
            }

            if (!FL::isPhone($phone)) {
                $errors[] = 'Невалидный телефон';
            }

            if (!FL::isValue($comment)) {
                $errors[] = 'Комментарий не может быть пустым';
            }

            if (empty($errors)) {
                $productsKeysArray = Session::getSession('products');
                if ($productsKeysArray) {
                    $products = json_encode($productsKeysArray);
                }

                $cart = new CartModel;
                $cart->user_name     = $name;
                $cart->user_phone    = $phone;
                $cart->user_comment  = $comment;
                $cart->user_id   = $userId;
                $cart->products = $products;
                $orderId = $cart->save();

                if ($orderId) {
                    Session::deleteSession('products');
                    Session::createSession('message', 'Заказ оформлен!');
                    FL::redirectTo('/cart');
                }
            }
        } else {
            $countProducts = CartModel::countProductsInCart();
            if ($countProducts <= 0) {
                FL::redirectTo('/');
            }
        }

        $view = new View;
        $view->categories  = $categories;
        $view->amountPrice = $amountPrice;
        $view->userName    = $userName;
        $view->errors      = $errors;
        $view->display('cart/order.php');

        return true;
    }
}