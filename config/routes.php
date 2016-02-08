<?php

return array(
    'product/([0-9]+)' => 'product/view/$1', // actionView in ProductController
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', // actionCategory in CatalogController
    'category/([0-9]+)' => 'catalog/category/$1', // actionCategory in CatalogController
    'catalog/page-([0-9]+)' => 'catalog/index/$1', // actionIndex in CatalogController
    'catalog' => 'catalog/index', // actionIndex in CatalogController
    // for cabinet
    'cabinet/edit/([0-9]+)' => 'cabinet/edit/$1', // actionEdit in CabinetController
    'cabinet' => 'cabinet/index', // actionIndex in CabinetController
    // for user
    'register' => 'user/register', // actionRegister in UserController
    'login' => 'user/login', // actionLogin in UserController
    'logout' => 'user/logout', // actionLogout in UserController
    // for main page
    'contacts' => 'site/contact', // actionContact in SiteController
    '' => 'site/index', // actionIndex in SiteController
 );