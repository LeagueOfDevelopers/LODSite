<div class="container">

    <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
            <ol class="breadcrumb">
                <li><a href="/">Главная</a></li>
                <li class="active">Форум</li>
            </ol>

            <?php
            $this->includeModuleView('forum');
            ?>
        </div>
    </div>

    <?php
    $this->includeView('footer');
    ?>
</div>