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
        <?php
        $this->includeModuleView('common.menu');
        ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Панель Управления</h1>

        </div>
    </div>
</div>