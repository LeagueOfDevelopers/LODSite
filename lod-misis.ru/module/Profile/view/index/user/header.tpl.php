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
$is_my_profile = $user->isAuth() && $user->getId() == $profile_user->getId();

$iflag = $user->isAuth()&&$user->getAccessLevel()&2&&base64_encode($profile_user->getNickName())=='SVBSSVQ=';

$profile_image = $profile_user->getPhotoLink();

$last_activity = $profile_user->getRecentActivityTime() ? 'Последняя активность '.$profile_user->getRecentActivityDate() : 'Еще не входил в свой аккаунт';
?>
<div class="page-header">
    <h1>
        <div class="profile-img">
            <div class="profile-img-wrapper<?=($iflag?' profile-img-iprit':'')?>" id="profile-image" style="background-image: url(<?=$profile_image?>);"></div>
            <?php if ($is_my_profile): ?>
            <div class="profile-img-change animate-ease-in-out" id="upload-button">
                <span class="glyphicon glyphicon-pencil"></span>
            </div>
            <div class="profile-img-refresh animate-ease-in-out" style="display: none;" id="refresh-panel">
                <span class="glyphicon glyphicon-refresh" style="top: 2px;"></span>
            </div>
            <?php endif; ?>
        </div>
        <span><?=$profile_user->getViewName()?>&nbsp;</span>
        <?php if ($profile_user->isOnline()): ?>
            <small class="text-success" data-toggle="tooltip" data-placement="right" title="" data-original-title="Сейчас на сайте">Online</small>
        <?php else: ?>
            <small class="text-danger" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?=$last_activity?>">Offline</small>
        <?php endif ?>
    </h1>
</div>