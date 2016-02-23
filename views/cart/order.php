<?php use App\Components\FunctionLibrary as FL; ?>
<?php $headTitle = 'Страница заказа' ?>
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
                    <h2 class="title text-center">Заказ</h2>
                    <div>Всего товаров: <strong class="app-orange-color"><?= \App\Models\CartModel::countProductsInCart() ?></strong> шт.</div>
                    <div>На сумму: <strong class="app-orange-color"><?= (float)$amountPrice ?></strong> US$</div>
                    <h5>Для оформления заказа заполните пожалуйста форму</h5>
                    <br>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="signup-form">
                                <?php if (!empty($errors)) : ?>
                                    <ul class="app-ul">
                                        <?php foreach ($errors as $error) : ?>
                                            <li class="app-red-color"><?= htmlentities($error); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                                <form action="/cart/order" method="post" class="app-form">
                                    <input type="text" name="name" value="<?= htmlentities($userName) ?>" placeholder="Имя">
                                    <input type="text" name="phone" value="" placeholder="Номер телефона">
                                    <textarea name="comment" placeholder="Комментарий к заказу"></textarea>
                                    <input type="submit" name="submit" class="btn btn-default app-button-submit" value="Заказать">
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