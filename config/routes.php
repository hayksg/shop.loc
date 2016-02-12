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
    // for cart
    'cart/add/([0-9]+)' => 'cart/add/$1', // actionAdd in CartController
    'cart/addProduct/([0-9]+)' => 'cart/addProduct/$1', // actionAddProduct in CartController
    'cart/delete/([0-9]+)' => 'cart/delete/$1', // actionDelete in CartController
    'cart/order' => 'cart/order', // actionOrder in CartController
    'cart' => 'cart/index', // actionIndex in CartController
    // for blog
    'blog/view/([0-9]+)' => 'blog/view/$1', // actionView in BlogController
    'blog' => 'blog/index', // actionIndex in BlogController
    // for main page
    'about' => 'site/about', // actionAbout in SiteController
    'contacts' => 'site/contact', // actionContact in SiteController
    '' => 'site/index', // actionIndex in SiteController
 );