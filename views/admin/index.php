<?php $headTitle = 'Административная часть' ?>
<?php include(ROOT . '/views/layouts/admin-header.php') ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h4>Добрый день: Администратор</h4>
                <br>
                <p>Вам доступны следующие возможности:</p>
                <ul class="app-ul">
                    <li><a href="/admin/view">Управление видом</a></li>
                    <li><a href="/admin/user">Управление админами</a></li>
                    <li><a href="/admin/category">Управление категориями</a></li>
                    <li><a href="/admin/product">Управление товарами</a></li>
                    <li><a href="/admin/blog">Управление блогом</a></li>
                    <li><a href="/admin/order">Управление заказами</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php') ?>