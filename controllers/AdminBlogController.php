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
        $blogs = BlogModel::getAll(false, true);

        $view = new View();
        $view->blogs = $blogs;
        $view->display('admin_blog/index.php');

        return true;
    }

    public function actionCreate()
    {
        $errors = [];

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
                    if ($_FILES['image']['name'] && $_FILES['image']['type'] == 'image/jpeg') {
                        $fileName = 'blog' . $id . '.jpg';
                        $tmpName = $_FILES['image']['tmp_name'];
                        if (is_uploaded_file($tmpName)) {
                            $imagePath = '/images/blog/' . $fileName;
                            $destination = ROOT . '/template/images/blog/' . $fileName;
                            $result = move_uploaded_file($tmpName, $destination);

                            if ($result) {
                                $blog = BlogModel::getById($id);
                                $blog->image = $imagePath;
                                $blog->save();
                            }
                        }
                    }
                }

                FL::redirectTo('/admin/blog');
            }
        }

        $view = new View();
        $view->errors      = $errors;
        $view->display('admin_blog/create.php');

        return true;
    }

    public function actionEdit($id)
    {
        $errors = [];

        $blog = BlogModel::getById($id);

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
                $blog->title       = $title;
                $blog->description = $description;
                $blog->content     = $content;
                $res = $blog->save();

                if ($res) {
                    if ($_FILES['image']['name'] && $_FILES['image']['type'] == 'image/jpeg') {
                        $fileName = 'blog' . $id . '.jpg';
                        $tmpName = $_FILES['image']['tmp_name'];
                        if (is_uploaded_file($tmpName)) {
                            $imagePath = '/images/blog/' . $fileName;
                            $destination = ROOT . '/template/images/blog/' . $fileName;
                            $result = move_uploaded_file($tmpName, $destination);

                            if ($result) {
                                $blog->image = $imagePath;
                                $blog->save();
                            }
                        }
                    }
                }

                FL::redirectTo('/admin/blog');
            }
        }

        $view = new View();
        $view->blog   = $blog;
        $view->errors = $errors;
        $view->display('admin_blog/edit.php');

        return true;
    }

    public function actionDelete($id)
    {
        $blog = BlogModel::delete($id);
        if ($blog) {
            FL::redirectTo('/admin/blog');
        }
        return true;
    }
}