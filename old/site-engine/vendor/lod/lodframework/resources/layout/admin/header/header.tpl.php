<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
/** @var \Lod\User\User $user */
$user = $this->getData()['user'];
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Переключить навигацию</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/adminium" data-toggle="tooltip" data-placement="right" title="Лига Разработчиков"><img src="/st/img/lodlogogray.png"></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="/adminium">Панель Управления</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/">На сайт</a></li>
                <li class="dropdown">
                    <a href="/profile" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span>
                        <?=$user->getViewName()?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/profile">Профиль</a></li>
                        <li class="divider"></li>
                        <li><a href="/profile/edit">Редактировать</a></li>
                        <li class="divider"></li>
                        <li><a href="/user/logout">Выход</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>