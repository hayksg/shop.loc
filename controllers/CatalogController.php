<?php

namespace App\Controllers;

use App\Components\View;
use App\Components\Pagination;
use App\Components\FunctionLibrary as FL;
use App\Models\CategoryModel;
use App\Models\ProductModel;


class CatalogController
{
    public function actionIndex($page = 1)
    {
        $limit = 9;

        $categories = CategoryModel::getAllUsingColumns();
        $products   = ProductModel::getAllUsingColumns(true, $limit, $page);
        if (!$products) { $products = []; }

        $total = ProductModel::getTotal();
        $pagination = FL::buildPagination($total, $page, $limit, 'page-');

        $view = new View;
        $view->categories = $categories;
        $view->products   = $products;
        if (isset($pagination)) {
            $view->pagination = $pagination;
        }
        $view->display('catalog/index.php');

        return true;
    }

    public function actionCategory($categoryId, $page = 1)
    {
        $limit = 9;
        $page = (int)$page;

        $categories = CategoryModel::getAllUsingColumns();
        $products   = ProductModel::getByCategoryId($categoryId, $limit, $page);
        if (!$products) { $products = []; }

        $total = ProductModel::getTotal('category_id', $categoryId);
        $pagination = FL::buildPagination($total, $page, $limit, 'page-');

        $view = new View;
        $view->categories = $categories;
        $view->products   = $products;
        $view->categoryId = $categoryId;
        if (isset($pagination)) {
            $view->pagination = $pagination;
        }
        $view->display('catalog/category.php');

        return true;
    }
}