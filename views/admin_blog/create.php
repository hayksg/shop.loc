<?php $headTitle = 'Административная часть' ?>
<?php include(ROOT . '/views/layouts/admin-header.php') ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель админинстратора</a></li>
                    <li><a href="/admin/blog">Управление блогом</a></li>
                    <li class="active">Создание блога</li>
                </ul>
                <br>
                <h4 class="app-grey-color">Форма для создания блога</h4>
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
                        <form action="/admin/blog/create" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="idTitle">
                                    <span class="pull-left">Название:</span>
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" class="form-control" id="idTitle">
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
                                <label class="control-label col-sm-3" for="idContent">
                                    <span class="pull-left">Контент:</span>
                                </label>
                                <div class="col-sm-9">
                                    <textarea name="content" class="form-control" id="idContent" rows="10"></textarea>
                                </div>
                            </div>
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
                                    <input type="submit" name="submit" class="btn btn-info" value="&nbsp;&nbsp;Создать&nbsp;&nbsp;">
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