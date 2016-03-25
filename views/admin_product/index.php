<?php $headTitle = 'Административная часть' ?>
<?php include(ROOT . '/views/layouts/admin-header.php') ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель админинстратора</a></li>
                    <li class="active">Управление товарами</li>
                </ul>
                <br>
                <?php if (empty($products)) : ?>
                    <h4 class="app-grey-color">На сегодня товаров нету!</h4>
                <?php else : ?>
                    <div>
                        <a href="/admin/product/create" class="btn btn-info">Добавить продукт</a>
                    </div>
                    <br>
                    <h4 class="app-grey-color">Таблица продуктов</h4>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped app-admin-blog-table">
                            <tr>
                                <th>Id</th>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Изготовитель</th>
                                <th>Артикул</th>
                                <th>Цена US $</th>
                                <th>Изображение</th>
                                <th>Редактировать</th>
                                <th>Удалить</th>
                            </tr>
                            <?php foreach ($products as $product) : ?>
                                <tr>
                                    <td><?= (int)$product->id ?></td>
                                    <td><?= htmlentities($product->name) ?></td>
                                    <td><?= htmlentities($product->description) ?></td>
                                    <td><?= htmlentities($product->brand) ?></td>
                                    <td><?= (int)$product->code ?></td>
                                    <td><?= (int)$product->price ?></td>
                                    <td><img src="/template/<?= htmlentities($product->image) ?>" width="54" height="50"></td>
                                    <td><a href="/admin/product/edit/<?= (int)$product->id ?>"><i class="fa fa-edit"></i></a></td>
                                    <td>
                                        <a href="/admin/product/delete/<?= (int)$product->id ?>">
                                            <i class="fa fa-trash-o fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <br>
                    <br>
                    <div class="text-center"><?php if (isset($pagination)) { echo $pagination->get(); } ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php') ?>