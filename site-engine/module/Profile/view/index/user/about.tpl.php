<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$profile_user = $this->getData()['profile_user'];
$user = $this->getData()['user'];
/**
 * @var $profile_user \Lod\User\User
 * @var $user \Lod\User\User
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">О себе</div>
    <div class="panel-body">
        <?=$profile_user->getAbout()?>
    </div>
</div>