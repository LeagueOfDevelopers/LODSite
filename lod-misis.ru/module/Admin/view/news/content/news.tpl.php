<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$user = $this->getData()['user'];
/**
 * @var $user \Lod\User\User
 */
?>
<p>
    <a class="btn btn-primary" href="/adminium/news?act=add">
        <span class="glyphicon glyphicon-plus"></span>
        Добавить новость
    </a>
</p>
<div class="row">
    <div class="col-xs-12">

        <?php
        $this->includeModuleView('news.pagination');
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">Список новостей</div>

            <?php
            $this->includeModuleView('news.list');
            ?>
        </div>
        <?php
        $this->includeModuleView('news.pagination');
        ?>

    </div>
</div>