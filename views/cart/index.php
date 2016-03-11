<?php use App\Components\FunctionLibrary as FL; ?>
<?php $headTitle = 'Страница корзины' ?>
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
                    <h2 class="title text-center">Корзина</h2>
                    <div class="app-block">
                        <?php if (empty($products)) : ?>

                            <?php $message = \App\Components\Session::getSession('message', true); ?>
                            <?php if ($message) : ?>
                                <h4 class="app-title-example app-grey-color">
                                    <?= htmlentities($message) ?>
                                </h4>
                            <?php else : ?>
                                <h4 class="app-title-example app-grey-color">Корзина пуста!</h4>
                            <?php endif; ?>

                        <?php else : ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <tr>
                                    <th>Артикул</th>
                                    <th>Торговая марка</th>
                                    <th>Название</th>
                                    <th>Цена US$</th>
                                    <th>Количество</th>
                                    <th>Удалить</th>
                                </tr>
                                <?php foreach ($products as $product) : ?>
                                <tr>
                                    <td><?= (int)$product->code ?></td>
                                    <td><?= htmlentities($product->brand) ?></td>
                                    <td><?= htmlentities($product->name) ?></td>
                                    <td><?= (float)$product->price ?></td>
                                    <td><?= \App\Components\Session::getSessionValue('products', $product->id) ?> шт.</td>
                                    <td><a href="/cart/delete/<?= (int)$product->id ?>">Удалить</a></td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                        <div>Всего товаров: <strong class="app-orange-color"><?= \App\Models\CartModel::countProductsInCart() ?></strong> шт.</div>
                        <div>На сумму: <strong class="app-orange-color"><?= (float)$amountPrice ?></strong> US$</div>
                        <br>
                        <p><a href="/cart/order" class="btn btn-info">Оформить заказ</a></p>
                    </div>
                    <?php endif; ?>
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php') ?>