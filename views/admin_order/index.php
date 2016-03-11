<?php $headTitle = 'Административная часть' ?>
<?php include(ROOT . '/views/layouts/admin-header.php') ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель админинстратора</a></li>
                    <li class="active">Управление заказом</li>
                </ul>
                <br>
                <br>
                <?php if (!empty($orders)) : ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <tr>
                                <th>Заказчик</th>
                                <th>Телефон</th>
                                <th>Комментарий к заказу</th>
                                <th>Дата заказа</th>
                                <th>Статус</th>
                                <th>Посмотреть заказ</th>
                                <th>Редактировать</th>
                                <th>Удалить</th>
                            </tr>
                        <?php foreach ($orders as $order) : ?>
                            <tr>
                                <td><?= htmlentities($order->user_name) ?></td>
                                <td><?= htmlentities($order->user_phone) ?></td>
                                <td><?= htmlentities($order->user_comment) ?></td>
                                <td><?= \App\Components\FunctionLibrary::getDate($order->date, true) ?></td>
                                <td><?= \App\Components\FunctionLibrary::getStatus($order->status) ?></td>
                                <td><a href="/admin/order/view/<?= (int)$order->id ?>"><i class="fa fa-eye"></i></a></td>
                                <td><a href="/admin/order/edit/<?= (int)$order->id ?>"><i class="fa fa-edit"></i></a></td>
                                <td><a href="/admin/order/delete/<?= (int)$order->id ?>"><i class="fa fa-trash-o"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php') ?>