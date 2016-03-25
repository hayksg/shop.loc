<?php

namespace App\Controllers;

use App\Components\FunctionLibrary as FL;
use App\Components\View;
use App\Models\ProductModel;
use App\Models\ProductOrderModel;

class AdminOrderController
{
    public function actionIndex()
    {
        $orders = ProductOrderModel::getAll();

        $view = new View();
        $view->orders = $orders;
        $view->display('admin_order/index.php');

        return true;
    }

    public function actionView($id)
    {
        $order = ProductOrderModel::getById($id);

        $productsArray = json_decode($order->products, true);
        $productsIds = implode(', ', array_keys($productsArray));
        $products = ProductModel::getAll($productsIds);
        $countProducts = ProductOrderModel::countProductsInOrder($productsArray);
        $amountProducts = ProductOrderModel::amountProductsPriceInCart($productsArray, $products);

        $view = new View();
        $view->products = $products;
        $view->productsArray = $productsArray;
        $view->countProducts = $countProducts;
        $view->amountProducts = $amountProducts;
        $view->display('admin_order/view.php');

        return true;
    }

    public function actionEdit($id)
    {
        $order = ProductOrderModel::getById($id);

        if (isset($_POST['submit'])) {
            $status = (int)$_POST['status'];

            if ($status) {
                $order->status = $status;
                $result = $order->save();

                if ($result) {
                    FL::redirectTo('/admin/order');
                }
            }
        }

        $view = new View();
        $view->order = $order;
        $view->display('admin_order/edit.php');

        return true;
    }

    public function actionDelete($id)
    {
        if ($id) {
            ProductOrderModel::delete($id);
            FL::redirectTo('/admin/order');
        }

        return true;
    }
}
