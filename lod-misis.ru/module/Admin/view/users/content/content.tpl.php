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
            <h1 class="page-header">Пользователи</h1>
            <?php
            switch ($action) {
                case 'show':
                    $this->includeModuleView('users.new_users');
                    $this->includeModuleView('users.users_list');
                    break;
                case 'edit':
                    $this->includeModuleView('users.edit');
                    break;
                default:
                    $this->includeModuleView('users.new_users');
                    $this->includeModuleView('users.users_list');
                    break;
            }
            ?>
        </div>
    </div>
</div>