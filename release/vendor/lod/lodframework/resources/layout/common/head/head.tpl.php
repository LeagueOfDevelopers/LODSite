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
                <!--<li><a href="/portfolio">Портфолио</a></li>-->
                <li><a href="/orders">Стол заказов</a></li>
                <li><a href="/about">О нас</a></li>
                <li><a href="/feedback">Обратная связь</a></li>
                <!--<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Разное <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/about">О нас</a></li>
                        <li><a href="/feedback">Обратная связь</a></li>
                    </ul>
                </li>-->
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Войти <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-login" role="menu">
                        <form class="navbar-form" role="login" onsubmit="User.signInStart(); return !1;">
                            <li role="presentation" class="dropdown-header">Логин</li>
                            <li>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                    <input type="text" id="head_form_login" class="form-control" placeholder="Логин">
                                </div>
                            </li>
                            <li role="presentation" class="dropdown-header">Пароль</li>
                            <li>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                    <input type="password" id="head_form_password" class="form-control" placeholder="Пароль">
                                </div>
                                <div class="head-form-error" style="display: none;">
                                    <small class="help-block">Неправильная пара логин/пароль</small>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li><button type="submit" onclick="User.signInStart(); return !1;" class="btn btn-default">Войти</button> <a style="margin-left: 8px;" href="/user/resetPassword">Забыли пароль?</a></li>
                            <li></li>
                        </form></ul>
                </li>
                <li><a href="/user/register">Регистрация разработчика</a></li>
                <!--<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-search" style="margin-right: 3px;"></span> Поиск</a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <form class="navbar-form" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Поиск">
                                </div>
                            </form>
                        </li>
                    </ul>
                </li>-->
            </ul>
        </div>
    </div>
</nav>