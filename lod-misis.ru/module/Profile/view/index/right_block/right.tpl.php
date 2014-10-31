<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
?>
<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">

    <div class="page-header">
        <h1><small>Последние посетители сайта</small></h1>
    </div>

    <?php
    $this->includeModuleView('recent_activity_users');
    ?>

</div>