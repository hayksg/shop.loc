<?php

namespace App\Controllers;

use App\Components\AdminBase;
use App\Components\View;
use App\Components\FunctionLibrary as FL;
use App\Models\BlogModel;


class AdminBlogController extends AdminBase
{
    public function actionIndex()
    {
        $blogs = BlogModel::getAll();

        $view = new View();
        $view->blogs = $blogs;
        $view->display('admin_blog/index.php');

        return true;
    }

    public function actionCreate()
    {
        $title       = '';
        $description = '';
        $content     = '';
        $errors      = [];

        if (isset($_POST['submit'])) {
            $title       = FL::clearStr($_POST['title']);
            $description = FL::clearStr($_POST['description']);
            $content     = FL::clearStr($_POST['content']);

            if (!FL::isValue($title)) {
                $errors[] = 'Название не может быть пустым';
            }

            if (!FL::isValue($description)) {
                $errors[] = 'Описание не может быть пустым';
            }

            if (!FL::isValue($content)) {
                $errors[] = 'Контент не может быть пустым';
            }

            if (empty($errors)) {
                $blog = new BlogModel();

                $blog->title       = $title;
                $blog->description = $description;
                $blog->content     = $content;
                $id = $blog->save();

                if ($id) {
                    if ($_FILES['image']['name']) {
                        $name = $_FILES['image']['name'];
                        $tmpName = $_FILES['image']['tmp_name'];
                        $imagePath = '/images/blog/' . $id;
                        $destination = ROOT . '/template/images/blog/' . $id;
                        $result = move_uploaded_file($tmpName, $destination);

                        if ($result) {
                            $blog = BlogModel::getById($id);
                            $blog->image = $imagePath;
                            $blog->save();
                        }
                    }
                }

                FL::redirectTo('/admin/blog');
            }
        }

        $view = new View();
        $view->title       = $title;
        $view->description = $description;
        $view->content     = $content;
        $view->errors      = $errors;
        $view->display('admin_blog/create.php');

        return true;
    }

    public function actionEdit()
    {
        require_once(ROOT . '/views/admin_blog/edit.php');
        return true;
    }

    public function actionDelete()
    {

        return true;
    }
}