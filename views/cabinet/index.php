<?php use App\Components\FunctionLibrary as FL; ?>
<?php $headTitle = 'Кабинет' ?>
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
                    <h2 class="title text-center">Кабинет</h2>
                    <h4 class="app-title-example app-grey-color">Добро пожаловать:
                        <strong><em class="app-orange-color"><?= htmlentities($user->name) ?></em></strong>
                    </h4>
                    <br>
                    <ul class="app-ul">
                        <li><a href="/cabinet/edit/<?= (int)$user->id ?>">Редактировать данные</a></li>
                        <li><a href="/product/history">Журнал заказов</a></li>
                    </ul>
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php') ?>