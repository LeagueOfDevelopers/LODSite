<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-12 col-sm-9">
        <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Показать колонку</button>
        </p>

        <?php
        $this->includeModuleView('navigation');
        ?>

        <?php
        $this->includeModuleView('user.header');
        ?>

        <?php
        $this->includeModuleView('user.actions');
        ?>

        <?php
        $this->includeModuleView('user.info');
        ?>

        <?php
        $this->includeModuleView('user.about');
        ?>
    </div>

    <?php
    $this->includeModuleView('right_block');
    ?>
</div>