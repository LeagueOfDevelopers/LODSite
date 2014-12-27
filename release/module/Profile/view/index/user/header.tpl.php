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

$profile_image = $profile_user->getPhotoLink();

$last_activity = $profile_user->getRecentActivityTime() ? 'Последняя активность '.$profile_user->getRecentActivityDate() : 'Еще не входил в свой аккаунт';
?>
<div class="page-header">
    <h1>
        <div class="profile-img animate-ease-in-out">
            <div class="profile-img-wrapper" id="profile-image" style="background-image: url(<?=$profile_image?>);"></div>
            <?php if ($is_my_profile): ?>
                <div class="profile-img-change animate-ease-in-out" id="upload-button">
                    <span class="glyphicon glyphicon-pencil"></span>
                </div>
                <div class="profile-img-refresh animate-ease-in-out" style="display: none;" id="refresh-panel">
                    <span class="glyphicon glyphicon-refresh" style="top: 2px;"></span>
                </div>

                <div class="profile-img-plus animate-ease-in-out resize-full" onclick="Profile.resizeFull(this)" style="top: 30px;">
                    <span class="glyphicon glyphicon-resize-full"></span>
                </div>
                <div class="profile-img-minus animate-ease-in-out resize-small" style="top: 30px; display: none;" onclick="Profile.resizeSmall(this)">
                    <span class="glyphicon glyphicon-resize-small"></span>
                </div>
            <?php else: ?>
            <div class="profile-img-plus animate-ease-in-out resize-full" onclick="Profile.resizeFull(this)">
                <span class="glyphicon glyphicon-resize-full"></span>
            </div>
            <div class="profile-img-minus animate-ease-in-out resize-small" style="display: none;" onclick="Profile.resizeSmall(this)">
                <span class="glyphicon glyphicon-resize-small"></span>
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