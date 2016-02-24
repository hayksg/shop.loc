<?php

namespace App\Controllers;

use App\Components\AdminBase;
use App\Models\CategoryModel;
use App\Components\View;
use App\Components\FunctionLibrary as FL;

class AdminCategoryController extends AdminBase
{
    public function actionIndex()
    {
        $categories = CategoryModel::getAll(false, true);

        $view = new View();
        $view->categories = $categories;
        $view->display('admin_category/index.php');

        return true;
    }

    public function actionCreate()
    {
        $errors    = [];
        $name      = '';
        $sortOrder = '';
        $status    = '';

        $categories = CategoryModel::getAll(false, true);
        $totalCategories = CategoryModel::getTotal();
        $currentCategory = $totalCategories + 1;

        if (isset($_POST['submit'])) {
            $name      = FL::clearStr($_POST['name']);
            $status    = FL::clearInt($_POST['status']);
            $sortOrder = FL::clearInt($currentCategory);

            if (!FL::isValue($name)) {
                $errors[] = 'Название не может быть пустым';
            }

            if (empty($errors)) {
                $category = new CategoryModel();
                $category->name = $name;
                $category->sort_order = $sortOrder;
                $category->status = $status;

                $res = $category->save();
                if (!$res) {
                    $errors[] = 'Произошла ошибка при добавлении!';
                } else {
                    FL::redirectTo('/admin/category');
                }

            }
        }

        $view = new View();
        $view->categories = $categories;
        $view->currentCategory = $currentCategory;
        $view->errors = $errors;
        $view->display('admin_category/create.php');

        return true;
    }

    public function actionEdit($id)
    {
        $category = CategoryModel::getById($id);
        $totalCategories = CategoryModel::getTotal();

        if (isset($_POST['submit'])) {
            $name      = FL::clearStr($_POST['name']);
            $sortOrder = FL::clearInt($_POST['sortOrder']);
            $status    = FL::clearInt($_POST['status']);

            if (!FL::isValue($name)) {
                $errors[] = 'Название не может быть пустым';
            }

            if (empty($errors)) {
                $category->name       = $name;
                $category->sort_order = $sortOrder;
                $category->status     = $status;
                $result = $category->save();

                if (!$result) {
                    $errors[] = 'Редактирование не удалось';
                } else {
                    FL::redirectTo('/admin/category');
                }
            }
        }

        $view = new View();
        $view->category = $category;
        $view->totalCategories = $totalCategories;
        $view->display('admin_category/edit.php');

        return true;

    }

    public function actionDelete($id)
    {
        CategoryModel::delete($id);
        FL::redirectTo('/admin/category');

        return true;
    }
}