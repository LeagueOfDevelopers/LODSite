<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$user = $this->getData()['user'];
/**
 * @var $user \Lod\User\User
 */
?>
<div class="container">

    <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
            <p class="pull-right visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Показать колонку</button>
            </p>

            <?php if (!$user->isAuth()): ?>
            <div class="jumbotron">
                <h1>Добро пожаловать!</h1>
                <p>Вы находитесь на сайте Лиги Разработчиков! У Вас есть интересная идея, но Вы не представляете как ее реализовать? Мы вам поможем!</p>
                <p><a class="btn btn-primary btn-lg" role="button" href="/orders">Стол заказов</a></p>
            </div>
            <?php endif; ?>

            <?php
            $this->includeModuleView('navigation');
            ?>

            <?php
            $this->includeModuleView('news');
            ?>

            <?php
            $this->includeModuleView('pagination');
            ?>

        </div>
        <?php
        $this->includeModuleView('right_block');
        ?>
    </div>

    <?php
    $this->includeView('footer');
    ?>
</div>