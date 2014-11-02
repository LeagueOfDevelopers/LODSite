<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
?>
<div class="container">

    <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
            <?php
            $this->includeModuleView('new_password.navigation');
            ?>

            <?php
            $this->includeModuleView('new_password.form');
            ?>
        </div>
    </div>

    <?php
    $this->includeView('footer');
    ?>
</div>