<?php use App\Components\FunctionLibrary as FL; ?>
<?php $headTitle = 'Страница регистрации' ?>
<?php include(ROOT . '/views/layouts/header.php') ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categories as $category) : ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="/category/<?= (int)$category->id; ?>"
                                           class="app-category"
                                        >
                                            <?= htmlentities($category->name); ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Регистрация</h2>
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                            <div class="signup-form">
                                <h2>Регистрация на сайте</h2>
                                <?php if (!empty($errors)) : ?>
                                    <ul class="app-ul">
                                        <?php foreach ($errors as $error) : ?>
                                            <li class="app-red-color"><?= htmlentities($error); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                                <form action="/register" method="post" class="app-form">
                                    <input type="text" name="name" value="<?= htmlentities($name); ?>" placeholder="Имя">
                                    <input type="email" name="email" value="<?= htmlentities($email); ?>" placeholder="Email">
                                    <input type="password" name="password" value="<?= htmlentities($password); ?>" placeholder="Пароль">
                                    <input type="submit" name="submit" class="btn btn-default add-to-cart" value="Зарегистрировать">
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php') ?>