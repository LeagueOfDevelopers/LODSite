<div class="container">

    <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
            <ol class="breadcrumb" style = "width:800px;">
                <li><a href="/">Главная</a></li>
                <li class="active">Портфолио</li>
            </ol>

            <?php
            $this->includeModuleView('portfolio.container');
            ?>
        </div>
    </div>

    <?php
    $this->includeView('footer');
    ?>
</div>