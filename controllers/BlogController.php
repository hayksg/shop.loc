<?php

namespace App\Controllers;

use App\Components\View;
use App\Components\FunctionLibrary as FL;
use App\Models\CategoryModel;
use App\Models\BlogModel;

class BlogController
{
    public function actionIndex()
    {
        $showBlogs = 6;

        $categories = CategoryModel::getAllUsingColumns();
        $blogs   = BlogModel::getAll();

        $view = new View;
        $view->categories = $categories;
        $view->blogs   = $blogs;
        $view->display('blog/index.php');

        return true;
    }

    public function actionView($id)
    {
        $categories = CategoryModel::getAllUsingColumns();


        $view = new View;
        $view->categories = $categories;

        $view->display('blog/view.php');

        return true;
    }
}