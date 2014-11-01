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
    <?php
    $this->includeModuleView('navigation');
    ?>

    <?php
    $type = $this->getData()['register.type'];
    switch ($type) {
        case 1:
            $this->includeModuleView('register.success');
            break;
        case 2:
            $this->includeModuleView('register.confirmed');
            break;
        default:
            $this->includeModuleView('register_form');
            break;
    }
    ?>

    <?php
    $this->includeView('footer');
    ?>
</div>