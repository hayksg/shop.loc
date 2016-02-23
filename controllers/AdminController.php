<?php

namespace App\Controllers;

use App\Components\AdminBase;
use App\Components\View;


class AdminController extends AdminBase
{
    public function actionIndex()
    {


        $view = new View;
        $view->display('admin/index.php');

        return true;
    }

}