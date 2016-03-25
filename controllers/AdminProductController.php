<?php

namespace App\Controllers;

use App\Components\FunctionLibrary as FL;
use App\Components\Pagination;
use App\Components\View;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ProductOrderModel;

class AdminProductController
{
    public function actionIndex($page = 1)
    {
        $limit = 10;
        $products = ProductModel::getAllUsingColumns(false, $limit, $page);

        $total = ProductModel::getTotal();
        $pagination = FL::buildPagination($total, $page, $limit, 'page-');


        $view = new View();
        $view->products = $products;
        $view->pagination = $pagination;
        $view->display('admin_product/index.php');

        return true;
    }

    public function actionCreate()
    {
        $errors = [];
        $categories = CategoryModel::getAll(false, true);
        $product = new ProductModel();

        if (isset($_POST['submit'])) {
            $name           = FL::clearStr($_POST['name']);
            $categoryId     = FL::clearInt($_POST['category_id']);
            $code           = FL::clearInt($_POST['code']);
            $price          = FL::clearFloat($_POST['price']);
            $availability   = FL::clearInt($_POST['availability']);
            $brand          = FL::clearStr($_POST['brand']);
            $description    = FL::clearStr($_POST['description']);
            $isNew          = FL::clearInt($_POST['is_new']);
            $isRecommended  = FL::clearInt($_POST['is_recommended']);
            $status         = FL::clearInt($_POST['status']);


            if (!FL::isValue($name)) {
                $errors[] = 'Название не может быть пустым';
            }

            if (empty($errors)) {
                $product->name          = $name;
                $product->categoryId    = $categoryId;
                $product->code          = $code;
                $product->price         = $price;
                $product->availability  = $availability;
                $product->brand         = $brand;
                $product->description   = $description;
                $product->isNew         = $isNew;
                $product->isRecommended = $isRecommended;
                $product->status        = $status;

                $id = $product->save();

                if (!$id) {
                    $errors[] = 'Произошла ошибка';
                } else {








                    FL::redirectTo('/admin/product');
                }
            }
        }

        $view = new View();
        $view->categories = $categories;
        $view->errors     = $errors;
        $view->display('admin_product/create.php');

        return true;
    }

    public function actionEdit($id)
    {
        $view = new View();
        $view->display('admin_product/edit.php');

        return true;
    }

    public function actionDelete($id)
    {
        $product = ProductModel::getById($id);

        if (isset($_POST['delNo'])) {
            FL::redirectTo('/admin/product');
        }

        if (isset($_POST['delYes'])) {
            $result = ProductModel::delete($id);
            if ($result) {
                FL::redirectTo('/admin/product');
            }
        }

        $view = new View();
        $view->product = $product;
        $view->display('admin_product/delete.php');

        return true;
    }
}