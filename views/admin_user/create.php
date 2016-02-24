<?php $headTitle = 'Административная часть' ?>
<?php include(ROOT . '/views/layouts/admin-header.php') ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li><a href="/admin">Панель админинстратора</a></li>
                        <li><a href="/admin/user">Управление админами</a></li>
                        <li class="active">Регистрация админа</li>
                    </ul>
                    <br>
                    <h4 class="app-grey-color">Форма для регистрации админа</h4>
                    <br>
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-sm-8 col-xs-10">
                            <?php if (!empty($errors)) : ?>
                                <ul class="app-ul">
                                    <?php foreach ($errors as $error) : ?>
                                        <li class="app-red-color"><?= htmlentities($error); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <form action="/admin/user/create" method="post" class="form-horizontal app-admin-form">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="idName">Имя:</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" class="form-control" id="idName">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="idEmail">Email:</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" id="idEmail" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="idPassword">Пароль:</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password" id="idPassword" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12 col-sm-offset-3">
                                        <input type="submit" name="submit" class="btn btn-success" value="&nbsp;&nbsp;Регистрировать&nbsp;&nbsp;">
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