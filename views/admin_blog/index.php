<?php $headTitle = 'Административная часть' ?>
<?php include(ROOT . '/views/layouts/admin-header.php') ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li><a href="/admin">Панель админинстратора</a></li>
                        <li class="active">Управление блогом</li>
                    </ul>
                    <br>
                    <?php if (empty($blogs)) : ?>
                    <h4>Пока записей нет! Вы можете добавить их.</h4>
                    <br>
                    <div>
                        <a href="/admin/blog/create" class="btn btn-info">Добавить блог</a>
                    </div>
                    <?php else : ?>
                    <div>
                        <a href="/admin/blog/create" class="btn btn-info">Добавить блог</a>
                    </div>
                    <br>
                    <h4 class="app-grey-color">Таблица блогов</h4>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped app-admin-blog-table">
                            <tr>
                                <th>Id</th>
                                <th>Заглавие</th>
                                <th>Описание</th>
                                <th>Контент</th>
                                <th>Дата</th>
                                <th>Изображение</th>
                                <th>Редактировать</th>
                                <th>Удалить</th>
                            </tr>
                            <?php foreach ($blogs as $blog) : ?>
                                <tr>
                                    <td><?= (int)$blog->id ?></td>
                                    <td><?= htmlentities($blog->title) ?></td>
                                    <td><?= htmlentities($blog->description) ?></td>
                                    <td><?= htmlentities($blog->content) ?></td>
                                    <td><?= htmlentities($blog->dt) ?></td>
                                    <td><img src="/template/<?= htmlentities($blog->image) ?>" width="86" height="39"></td>
                                    <td><a href="/admin/blog/edit/<?= (int)$blog->id ?>"><i class="fa fa-edit"></i></a></td>
                                    <td>
                                        <a href="/admin/blog/delete/<?= (int)$blog->id ?>"
                                           onclick="return confirm('Вы уверены что хотите удалить блог?')"
                                        >
                                            <i class="fa fa-trash-o fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php include(ROOT . '/views/layouts/footer.php') ?>