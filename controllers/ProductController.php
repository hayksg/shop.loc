<?php

use App\Components\View;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class ProductController
{
    public function actionView($id)
    {
        $categories = CategoryModel::getAllUsingColumns();
        $product = ProductModel::getById($id);

        $view = new View;
        $view->categories = $categories;
        $view->product = $product;
        $view->display('product/view.php');

        return true;
    }
}