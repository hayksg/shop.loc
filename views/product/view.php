<?php $headTitle = 'Страница товара' ?>
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
                                           class="app-category <?php if ($category->id == $product->category_id) { echo "active"; } ?>"
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
                <?php if (!empty($product)) : ?>
                <div class="product-details"><!--product-details-->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="/template<?= htmlentities($product->image) ?>" class="img-responsive" alt="image">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <?php if ($product->is_new) : ?>
                                <img src="/template/images/product-details/new.jpg" class="newarrival" alt="image-new">
                                <?php endif; ?>
                                <h2><?= htmlentities($product->name) ?></h2>
                                <p><b>Код товара:</b> <?= (int)$product->code ?></p>
                                <p><b>Цена:</b>
                                    <i class="app-orange-color">US $
                                        <i class="app-product-price"><?= (float)$product->price ?></i>
                                    </i>
                                </p>
                                <span>
                                    <label>Количество:</label>
                                    <input type="text"
                                           class="app-product-count"
                                           value="<?= \App\Components\Session::getSessionValue('products', $product->id) ?>"
                                    >
                                </span>
                                <p><b>Общая сумма:</b>
                                    <i class="app-orange-color">US $
                                        <i class="app-product-amount">0</i>
                                    </i>
                                </p>
                                <p><b>Наличие:</b> На складе</p>
                                <p><b>Состояние:</b> Новое</p>
                                <p><b>Производитель:</b> <?= htmlentities($product->brand) ?></p>
                                <br>
                                <a href="#"
                                   class="btn btn-default add-to-cart add-to-cart-one app-btn-orange app-button cart"
                                   data-id="<?= (int)$product->id; ?>"
                                >
                                    <i class="fa fa-shopping-cart"></i>В корзину
                                </a>
                            </div><!--/product-information-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Описание товара</h5>
                            <p><?= htmlentities($product->description) ?></p>
                        </div>
                    </div>
                </div><!--/product-details-->
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php') ?>