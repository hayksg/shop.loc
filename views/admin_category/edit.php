<?php $headTitle = 'Административная часть' ?>
<?php include(ROOT . '/views/layouts/admin-header.php') ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель админинстратора</a></li>
                    <li><a href="/admin/category">Управление категориями</a></li>
                    <li class="active">Редактирование категории</li>
                </ul>
                <br>
                <div class="row">
                    <div class="col-lg-6 col-md-7 col-sm-9 col-xs-10">
                        <?php if (!$category) : ?>
                            <h3>Категория не найдена</h3>
                        <?php else : ?>
                            <?php if (!empty($errors)) : ?>
                                <ul class="app-ul">
                                    <?php foreach ($errors as $error) : ?>
                                        <li class="app-red-color"><?= htmlentities($error); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <form action="#" method="post" class="form-horizontal app-admin-form">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="idName">Название категории:</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" class="form-control" id="idName"  value="<?= htmlentities($category->name) ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Порядковый номер:</label>
                                    <div class="col-sm-8">
                                        <select name="sortOrder" class="form-control">
                                            <?php for ($count = 1; $count <= $totalCategories; $count++) : ?>
                                                <?php if ($count == $category->sort_order) : ?>
                                                <option selected><?= $count?></option>
                                                <?php else : ?>
                                                <option><?= $count?></option>
                                                <?php endif; ?>
                                            <?php endfor;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Отображение:</label>
                                    <div class="col-sm-8">
                                        <select name="status" class="form-control">
                                            <option value="1" <?php if ($category->status == 1) {echo "selected"; } ?> >Да</option>
                                            <option value="0" <?php if ($category->status == 0) {echo "selected"; } ?> >Нет</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10 col-sm-offset-4">
                                        <input type="submit" name="submit" class="btn btn-success" value="&nbsp;&nbsp;Редактировать&nbsp;&nbsp;">
                                    </div>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php') ?>