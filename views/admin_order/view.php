<?php $headTitle = 'Административная часть' ?>
<?php include(ROOT . '/views/layouts/admin-header.php') ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель админинстратора</a></li>
                    <li><a href="/admin/order">Управление заказом</a></li>
                    <li class="active">Просмотр заказа</li>
                </ul>
                <br>
                <br>
                <?php if (!empty($products)) : ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Артикул</th>
                                <th>Название</th>
                                <th>Цена US$</th>
                                <th>Количество шт.</th>
                            </tr>
                            <?php foreach ($products as $product) : ?>
                            <tr>
                                <td><?= (int)$product->id ?></td>
                                <td><?= (int)$product->code ?></td>
                                <td><?= htmlentities($product->name) ?></td>
                                <td><?= (float)$product->price ?></td>
                                <td><?= (int)$productsArray[$product->id] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <div>Всего товаров: <strong class="app-orange-color"><?= $countProducts?></strong> шт.</div>
                    <div>На сумму: <strong class="app-orange-color"><?= $amountProducts ?></strong> US$</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php') ?>