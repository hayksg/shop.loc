<?php $headTitle = 'Административная часть' ?>
<?php include(ROOT . '/views/layouts/admin-header.php') ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель админинстратора</a></li>
                    <li><a href="/admin/category">Управление категориями</a></li>
                    <li class="active">Создание категории</li>
                </ul>
                <br>
                <br>
                <div class="row">
                    <div class="col-lg-6 col-md-7 col-sm-9 col-xs-10">
                        <?php if (!empty($errors)) : ?>
                            <ul class="app-ul">
                                <?php foreach ($errors as $error) : ?>
                                    <li class="app-red-color"><?= htmlentities($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <form action="/admin/category/create" method="post" class="form-horizontal app-admin-form">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="idName">Название категории:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" class="form-control" id="idName">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Порядковый номер:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="sortOrder" class="form-control" disabled value="<?= (int)$currentCategory ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Отображение:</label>
                                <div class="col-sm-8">
                                    <select name="status" class="form-control">
                                        <option value="1">Да</option>
                                        <option value="0">Нет</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-4">
                                    <input type="submit" name="submit" class="btn btn-success" value="&nbsp;&nbsp;Создать&nbsp;&nbsp;">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php') ?>