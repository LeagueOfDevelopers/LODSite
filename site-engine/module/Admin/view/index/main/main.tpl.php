<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$user = $this->getData()['user'];
/**
 * @var $user \Lod\User\User
 */
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><a href="/adminium">Главная страница</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li><a href="/adminium/news">Новости</a></li>
                <li><a href="/adminium/users">Пользователи</a></li>
                <li><a href="/adminium/orders">Заказы</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li><a href="/">Выход</a></li>
            </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Панель Управления</h1>

        </div>
    </div>
</div>