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
            <?php
            $this->includeModuleView('navigation');
            ?>

            <?php
            $this->includeModuleView('news');
            ?>

            <?php
            $this->includeModuleView('pagination');
            ?>

            <?php
            $this->includeModuleView('previews');
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