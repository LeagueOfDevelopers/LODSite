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
    $this->includeModuleView('register_form');
    ?>

    <?php
    $this->includeView('footer');
    ?>
</div>