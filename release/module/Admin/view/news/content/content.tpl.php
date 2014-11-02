<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$user = $this->getData()['user'];
/**
 * @var $user \Lod\User\User
 */
$action = $this->getData()['act'];
?>
<div class="container-fluid">
    <div class="row">
        <?php
        $this->includeModuleView('common.menu');
        ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Новости</h1>
            <?php
            switch ($action) {
                case 'add':
                    $this->includeModuleView('news.add_news');
                    break;
                case 'edit':
                    $this->includeModuleView('news.edit_news');
                    break;
                case 'show':
                    $this->includeModuleView('news.news_list');
                    break;
                default:
                    $this->includeModuleView('news.news_list');
                    break;
            }
            ?>
        </div>
    </div>
</div>