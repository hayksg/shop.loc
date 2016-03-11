<?php

namespace App\Controllers;

use App\Components\View;
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

    public function actionView()
    {
        $view = new View();
        $view->display('admin_order/view.php');

        return true;
    }

    public function actionEdit()
    {
        $view = new View();
        $view->display('admin_order/edit.php');

        return true;
    }

    public function actionDelete()
    {


        return true;
    }
}
