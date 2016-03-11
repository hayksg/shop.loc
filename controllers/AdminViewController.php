<?php

namespace App\Controllers;

use App\Components\View;
use App\Components\FunctionLibrary as FL;
use App\Models\AdminModel;

class AdminViewController
{
    public function actionIndex()
    {
        $product_count_main_page = FL::fileGetContents('product_count_main_page.txt');
        $product_count_catalog_page = FL::fileGetContents('product_count_catalog_page.txt');
        $product_count_category_page = FL::fileGetContents('product_count_category_page.txt');


        if (isset($_POST['submit'])) {
            if (isset($_POST['productCountMainPage'])) {
                $productCountMainPage = FL::clearInt($_POST['productCountMainPage']);
                AdminModel::filePutContents(ROOT . '/config/product_count_main_page.txt', $productCountMainPage);

            }

            if (isset($_POST['productCountCatalogPage'])) {
                $productCountCatalogPage = FL::clearInt($_POST['productCountCatalogPage']);
                AdminModel::filePutContents(ROOT . '/config/product_count_catalog_page.txt', $productCountCatalogPage);
            }

            if (isset($_POST['productCountCategoryPage'])) {
                $productCountCategoryPage = FL::clearInt($_POST['productCountCategoryPage']);
                AdminModel::filePutContents(ROOT . '/config/product_count_category_page.txt', $productCountCategoryPage);
            }

            FL::redirectTo('/admin/view');
        }

        $view = new View;
        $view->product_count_main_page = $product_count_main_page;
        $view->product_count_catalog_page = $product_count_catalog_page;
        $view->product_count_category_page = $product_count_category_page;
        $view->display('admin_view/index.php');
        return true;
    }
}