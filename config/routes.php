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

    // for admin blog
    'admin/blog/create' => 'adminBlog/create' , // actionCreate in AdminBlogController
    'admin/blog/edit/([0-9]+)' => 'adminBlog/edit/$1' , // actionEdit in AdminBlogController
    'admin/blog/delete/([0-9]+)' => 'adminBlog/delete/$1' , // actionDelete in AdminBlogController
    'admin/blog' => 'adminBlog/index' , // actionIndex in AdminBlogController

    // for admin category
    'admin/category/create' => 'adminCategory/create', // actionCreate in AdminCategoryController
    'admin/category/edit/([0-9]+)' => 'adminCategory/edit/$1', // actionEdit in AdminCategoryController
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1', // actionDelete in AdminCategoryController
    'admin/category' => 'adminCategory/index', // actionIndex in AdminCategoryController

    // for admin management
    'admin/user/create' => 'adminUser/create', // actionCreate in AdminUserController
    'admin/user/edit/([0-9]+)' => 'adminUser/edit/$1', // actionEdit in AdminUserController
    'admin/user/delete/([0-9]+)' => 'adminUser/delete/$1', // actionDelete in AdminUserController
    'admin/user' => 'adminUser/index', // actionIndex in AdminUserController

    // for admin
    'admin' => 'admin/index', // actionIndex in AdminController

    // for blog
    'blog/view/([0-9]+)' => 'blog/view/$1', // actionView in BlogController
    'blog' => 'blog/index', // actionIndex in BlogController

    // for main
    'about' => 'site/about', // actionAbout in SiteController
    'contacts' => 'site/contact', // actionContact in SiteController
    '' => 'site/index', // actionIndex in SiteController
 );