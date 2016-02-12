<?php use App\Components\FunctionLibrary as FL; ?>
<?php $headTitle = 'Все блоги' ?>
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
                        <div class="row">
                            <div class="col-sm-12 app-box">
                            <?php foreach ($blogs as $blog) : ?>
                            <div>
                                <h3 class="app-grey-color"><?= htmlentities($blog->title); ?></h3>
                                <p class="app-grey-color"><i class="fa fa-calendar"></i> <?= htmlentities(FL::getDate($blog->dt)) ?></p>
                                <br>
                                <div class="row">
                                    <div class="col-lg-4 col-md-5 col-sm-6">
                                        <img src="/template<?= htmlentities($blog->image); ?>" class="img-responsive">
                                        <br>
                                    </div>
                                    <div class="col-ld-8 col-md-7 col-sm-6 app-blog-description-box app-grey-color">
                                        <?= htmlentities($blog->description); ?>
                                    </div>
                                </div>
                                <br>
                                <p><a href="/blog/view/<?= (int)$blog->id ?>">Читать дальше <i class="fa fa-angle-double-right"></i></a></p>
                                <hr>
                            </div>
                            <?php endforeach; ?>
                            </div>
                        </div>
                    </div><!--features_items-->
                </div>
            </div>
        </div>
    </section>

<?php include(ROOT . '/views/layouts/footer.php') ?>