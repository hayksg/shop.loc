<?php $headTitle = 'Административная часть' ?>
<?php include(ROOT . '/views/layouts/admin-header.php') ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель админинстратора</a></li>
                    <li><a href="/admin/order">Управление заказом</a></li>
                    <li class="active">Редактирование заказа</li>
                </ul>
                <br>
                <div class="row">
                    <div class="col-sm-5">
                    <?php if (empty($order)) : ?>
                        <h4 class="app-grey-color">Такой заказ не существует!</h4>
                    <?php else : ?>
                        <h4 class="app-grey-color">Выбрать статус заказа:</h4>
                        <hr>
                        <form action="/admin/order/edit/<?= (int)$order->id ?>" method="post" class="form-inline">
                            <select name="status" class="form-control">
                                <?php for ($cnt = 1; $cnt <= 4; $cnt++) : ?>
                                    <?php if ($cnt == (int)$order->status) : ?>
                                    <option value="<?= $cnt ?>" selected>
                                        &nbsp;&nbsp;<?= \App\Components\FunctionLibrary::getStatus($cnt) ?>&nbsp;&nbsp;
                                    </option>
                                    <?php continue; ?>
                                    <?php endif; ?>
                                    <option value="<?= $cnt ?>">
                                        &nbsp;&nbsp;<?= \App\Components\FunctionLibrary::getStatus($cnt) ?>&nbsp;&nbsp;
                                    </option>
                                <?php endfor; ?>
                            </select>&nbsp;&nbsp;
                            <input type="submit" name="submit" value="Выбрать" class="btn btn-default">
                        </form>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php') ?>