<!DOCTYPE html>
<html lang="ru">
    <head>
        <?php
        /** @var $this \Lod\Core\View\View */
        $this->includeHeaders();
        ?>
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php
        /** @var $this \Lod\Core\View\View */
        $this->includePage();
        /** @var $this \Lod\Core\View\View */
        $this->includeScripts();
        ?>
    </body>
</html>