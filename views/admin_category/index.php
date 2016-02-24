<?php $headTitle = 'Административная часть' ?>
<?php include(ROOT . '/views/layouts/admin-header.php') ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="/admin">Панель админинстратора</a></li>
                    <li class="active">Управление категориями</li>
                </ul>
                <br>
                <div>
                    <a href="/admin/category/create" class="btn btn-info">Добавить категорию</a>
                </div>
                <br>
                <h4 class="app-grey-color">Таблица категорий</h4>
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped app-admin-category-table">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Порядок расположения</th>
                            <th>Статус</th>
                            <th>Редактировать</th>
                            <th>Удалить</th>
                        </tr>
                        <?php foreach ($categories as $category) : ?>
                        <tr>
                            <td><?= (int)$category->id ?></td>
                            <td><?= htmlentities($category->name) ?></td>
                            <td><?= (int)$category->sort_order ?></td>
                            <td><?= (int)$category->status ?></td>
                            <td><a href="/admin/category/edit/<?= (int)$category->id ?>"><i class="fa fa-edit"></i></a></td>
                            <td>
                                <a href="/admin/category/delete/<?= (int)$category->id ?>"
                                   onclick="return confirm('Вы уверены что хотите удалить категорию?')"
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
</section>

<?php include(ROOT . '/views/layouts/footer.php') ?>