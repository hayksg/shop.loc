<?php $headTitle = 'Административная часть' ?>
<?php include(ROOT . '/views/layouts/admin-header.php') ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель админинстратора</a></li>
                    <li><a href="/admin/product">Управление товарами</a></li>
                    <li class="active">Удаление товара</li>
                </ul>
                <br>
                <?php if (empty($product)) : ?>
                    <h4 class="app-grey-color">Товар не найден</h4>
                <?php else : ?>
                    <h4>Вы уверены что хотите удалить этот товар?</h4>
                    <br>
                    <img src="/template<?= htmlentities($product->image) ?>" class="img-responsive">
                    <br>
                    <br>
                    <div class="col-sm-3">
                        <form action="/admin/product/delete/<?= (int)$product->id ?>" method="post" class="app-form-product-delete">
                            <input type="submit" name="delYes" value="Да" class="btn btn-info">
                            <input type="submit" name="delNo" value="Нет" class="btn btn-danger pull-right">
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php') ?>