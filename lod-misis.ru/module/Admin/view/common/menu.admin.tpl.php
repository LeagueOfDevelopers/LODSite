<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$user = $this->getData()['user'];
/**
 * @var $user \Lod\User\User
 */
$menu_flag = $this->getData()['menu_flag'];
?>
<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li<?=$menu_flag == 'index' ? ' class="active"' : ''?>><a href="/adminium">Главная страница</a></li>
    </ul>
    <ul class="nav nav-sidebar">
        <li<?=$menu_flag == 'news' ? ' class="active"' : ''?>>
            <a href="/adminium/news">
                Новости
            </a>
        </li>
        <li<?=$menu_flag == 'users' ? ' class="active"' : ''?>><a href="/adminium/users">Пользователи</a></li>
        <li<?=$menu_flag == 'orders' ? ' class="active"' : ''?>><a href="/adminium/orders">Заказы</a></li>
    </ul>
    <ul class="nav nav-sidebar">
        <li><a href="/">Выход</a></li>
    </ul>
</div>