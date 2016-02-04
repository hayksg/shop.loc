<?php

use App\Components\View;
use App\Models\CategoryModel;
use App\Models\ProductModel;


class SiteController
{
    public function actionIndex()
    {
        $showProducts = 6;

        $categories = CategoryModel::getAllUsingColumns();
        $products   = ProductModel::getAllUsingColumns(true, $showProducts);

        $view = new View;
        $view->categories = $categories;
        $view->products   = $products;
        $view->display('site/index.php');

        return true;
    }
}