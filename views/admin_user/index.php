<?php $headTitle = 'Административная часть' ?>
<?php include(ROOT . '/views/layouts/admin-header.php') ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель админинстратора</a></li>
                    <li class="active">Управление админами</li>
                </ul>
                <br>
                <div>
                    <a href="/admin/user/create" class="btn btn-info">Добавить админа</a>
                </div>
                <br>
                <h4 class="app-grey-color">Таблица админов</h4>
                <br>
                <div class="row">
                    <div class="col-lg-7 col-md-8 col-sm-9">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped app-admin-user-table">
                                <tr>
                                    <th>Name</th>
                                    <th>Редактировать</th>
                                    <th>Удалить</th>
                                </tr>
                                <?php foreach ($users as $user) : ?>
                                    <tr>
                                        <td><?= htmlentities($user->name) ?></td>
                                        <td><a href="/admin/user/edit/<?= (int)$user->id ?>"><i class="fa fa-edit"></i></a></td>
                                        <td>
                                            <a href="/admin/user/delete/<?= (int)$user->id ?>"
                                               onclick="return confirm('Вы уверены что хотите удалить админа?')"
                                            >
                                                <i class="fa fa-trash-o fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php') ?>