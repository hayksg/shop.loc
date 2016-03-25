<?php $headTitle = 'Административная часть' ?>
<?php include(ROOT . '/views/layouts/admin-header.php') ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель админинстратора</a></li>
                    <li><a href="/admin/product">Управление товарами</a></li>
                    <li class="active">Добавление товара</li>
                </ul>
                <br>
                <h4 class="app-grey-color">Форма для добавления товара</h4>
                <br>
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-10">
                        <?php if (!empty($errors)) : ?>
                            <ul class="app-ul">
                                <?php foreach ($errors as $error) : ?>
                                    <li class="app-red-color"><?= htmlentities($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <form action="/admin/product/create" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="idName">
                                    <span class="pull-left">Название:</span>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="idName">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    <span class="pull-left">Категория:</span>
                                </label>
                                <div class="col-sm-9">
                                    <select name="category_id" class="form-control">
                                        <?php foreach ($categories as $category) : ?>
                                        <option value="<?= (int)$category->id ?>"><?= htmlentities($category->name) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="idCode">
                                    <span class="pull-left">Артикул:</span>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="code" class="form-control" id="idCode">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="idPrice">
                                    <span class="pull-left">Цена:</span>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="price" class="form-control" id="idPrice">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    <span class="pull-left">В наличии:</span>
                                </label>
                                <div class="col-sm-9">
                                    <select name="availability" class="form-control">
                                        <option value="1">Да</option>
                                        <option value="0">Нет</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="idBrand">
                                    <span class="pull-left">Бренд:</span>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="brand" class="form-control" id="idBrand">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="idDescription">
                                    <span class="pull-left">Описание:</span>
                                </label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control" id="idDescription" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    <span class="pull-left">Новинка:</span>
                                </label>
                                <div class="col-sm-9">
                                    <select name="is_new" class="form-control">
                                        <option value="1">Да</option>
                                        <option value="0">Нет</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    <span class="pull-left">Рекомендуемый:</span>
                                </label>
                                <div class="col-sm-9">
                                    <select name="is_recommended" class="form-control">
                                        <option value="1">Да</option>
                                        <option value="0">Нет</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    <span class="pull-left">Видимость:</span>
                                </label>
                                <div class="col-sm-9">
                                    <select name="status" class="form-control">
                                        <option value="1">Да</option>
                                        <option value="0">Нет</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <p class="app-red-color">Внимание! Изображение поддерживается только в формате .jpg</p>
                            <div class="form-group">
                                <label class="control-label col-sm-3">
                                    <span class="pull-left">Изображение:</span>
                                </label>
                                <div class="col-sm-9">
                                    <input type="file" class="jfilestyle" name="image" data-buttonText="Find file">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 col-sm-offset-3">
                                    <input type="submit" name="submit" class="btn btn-info" value="&nbsp;&nbsp;Добавить&nbsp;&nbsp;">
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