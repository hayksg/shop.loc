<?php use App\Components\FunctionLibrary as FL; ?>
<?php $headTitle = 'Страница блога' ?>
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
                    <h2 class="title text-center">Блог</h2>
                    <div class="app-block">
                        <?php if (!empty($blog)) : ?>
                            <h3 class="app-title-example app-grey-color"><?= htmlentities($blog->title) ?></h3>
                            <br>
                            <p class="app-soft-grey-color"><i class="fa fa-calendar"></i> <?= FL::getDate($blog->dt) ?></p>
                            <br>
                            <div><img src="/template<?= htmlentities($blog->image) ?>"</div>
                            <br>
                            <br>
                            <div><?= htmlentities($blog->content) ?></div>
                        <?php endif; ?>
                    </div>
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php') ?>