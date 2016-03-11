<?php $headTitle = 'Административная часть' ?>
<?php include(ROOT . '/views/layouts/admin-header.php') ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель админинстратора</a></li>
                    <li class="active">Управление видом</li>
                </ul>
                <br>
                <br>
                <div>
                    <p>Количество продуктов на главной странице</p>
                    <form action="/admin/view" method="post" class="form-inline">
                        <div class="form-group">
                            <input type="text" name="productCountMainPage" class="form-control" value="<?= (int)$product_count_main_page ?>">
                        </div>
                        <input type="submit" name="submit" value="Выбрать" class="btn btn-default">
                    </form>
                </div>
                <br>
                <hr>
                <br>
                <div>
                    <p>Количество продуктов на странице 'Каталог товаров'</p>
                    <form action="/admin/view" method="post" class="form-inline">
                        <div class="form-group">
                            <input type="text" name="productCountCatalogPage" class="form-control" value="<?= (int)$product_count_catalog_page ?>">
                        </div>
                        <input type="submit" name="submit" value="Выбрать" class="btn btn-default">
                    </form>
                </div>
                <br>
                <hr>
                <br>
                <div>
                    <p>Количество продуктов на странице 'Категории'</p>
                    <form action="/admin/view" method="post" class="form-inline">
                        <div class="form-group">
                            <input type="text" name="productCountCategoryPage" class="form-control" value="<?= (int)$product_count_category_page ?>">
                        </div>
                        <input type="submit" name="submit" value="Выбрать" class="btn btn-default">
                    </form>
                </div>
                <br>
                <hr>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php') ?>