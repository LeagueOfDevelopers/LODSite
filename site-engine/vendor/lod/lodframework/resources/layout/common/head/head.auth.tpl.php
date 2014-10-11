<?php
/** @var \Lod\Core\View\AbstractView $this */
$data = $this->getData();

/** @var \Lod\User\User $user */
$user = $data['user'];
?>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Переключить навигацию</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/" data-toggle="tooltip" data-placement="right" title="Лига Разработчиков"><img src="/st/img/lodlogo.png" alt="LoD"></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/">Главная</a></li>
                <li><a href="/forum">Форум</a></li>
                <li><a href="/orders">Стол заказов</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Разное <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/about">О нас</a></li>
                        <li><a href="/feedback">Обратная связь</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">proFox <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/profile">Профиль</a></li>
                        <li><a href="#">Сообщения <span class="badge">0 новых</span></a></li>
                        <li class="divider"></li>
                        <li><a href="#">Добавить новость</a></li>
                        <li class="divider"></li>
                        <li><a href="/settings">Настройки</a></li>
                        <li class="divider"></li>
                        <li><a href="/logout?hash=6da32eed5368dff2">Выход</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Поиск</a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <form class="navbar-form" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Поиск">
                                </div>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>