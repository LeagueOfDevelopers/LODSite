<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$user = $this->getData()['user'];
/**
 * @var $user \Lod\User\User
 */
?>
<div class="row">
    <div class="col-xs-12">

        <div class="panel panel-default">
            <div class="panel-heading">Добавить новость</div>

            <?php
            $this->includeModuleView('news.add_news.form');
            ?>
        </div>

    </div>
</div>