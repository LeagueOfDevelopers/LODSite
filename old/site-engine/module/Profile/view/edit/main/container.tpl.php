<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$success_flag = $this->getData()['success_flag'];
?>
<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-12 col-sm-9">
        <?php
        $this->includeModuleView('edit.navigation');
        ?>

        <?php
        $this->includeModuleView('edit.header');
        ?>

        <?php
        if ($success_flag):
        $this->includeModuleView('edit.success');
        endif;
        ?>

        <?php
        $this->includeModuleView('edit.form');
        ?>
    </div>
</div>