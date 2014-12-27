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
<div class="photo-container-wrapper" style="display: none;">
    <div class="photo-container" style="top: -20px;"></div>
</div>
<div id="photo-overlay" style="opacity: 0; position: fixed; height: 100%; width: 100%; background: rgba(0, 0, 0, 0.77); z-index: 1000; top: 0; left: 0; display: none;"></div>