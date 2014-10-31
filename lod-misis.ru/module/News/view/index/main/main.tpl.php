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
            $this->includeModuleView('news.navigation');
            ?>

            <?php
            $this->includeModuleView('news.header');
            ?>

            <?php
            $this->includeModuleView('news.content');
            ?>

            <?php
            $this->includeModuleView('news.noauth');
            ?>

            <?php
            $this->includeModuleView('news.comments');
            ?>

            <?php
            $this->includeModuleView('news.add_comment');
            ?>

        </div>

        <?php
        $this->includeModuleView('news.right_block');
        ?>
    </div>

    <?php
    $this->includeView('footer');
    ?>
</div>