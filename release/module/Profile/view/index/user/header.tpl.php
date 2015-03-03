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

$iflag = false;

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
        <?php if($user->isAuth() && $is_my_profile):?>
            <div class="profile-img">
            <?php if ($profile_user->getStatus() == 1):?>
            <a href = "/profile/changeStatus?id=<?=$profile_user->getId();?>&status=<?=$profile_user->getStatus();?>" style="color: #FFF; background: #78BF76; margin-right: 10px; margin-bottom: 10px; text-decoration:none; border-radius: 4px; padding: 9px 10px;font-size: 20px;"><span style="padding: 5px; font-size: 16px;" class="glyphicon glyphicon-ok"></span> Готов</a>
            </div>
            <?php else:?>
            <a href = "/profile/changeStatus?id=<?=$profile_user->getId();?>&status=<?=$profile_user->getStatus();?>" style="color: #FFF; background: #e67e22; margin-right: 10px; margin-bottom: 10px; text-decoration:none; border-radius: 4px; padding: 9px 10px;font-size: 20px;"><span style="padding: 5px;font-size: 16px;" class="glyphicon glyphicon-remove"></span> Не готов</a>
            </div>
            <?php endif;?>
        <?php endif;?>
        <?php if($user->isAuth() && !$is_my_profile):?>
            <div class="profile-img">
            <?php if ($profile_user->getStatus() == 1):?>
            <a href="#" style="cursor: default; color: #FFF; background: #78BF76; margin-right: 10px; margin-bottom: 10px; text-decoration:none; border-radius: 4px; padding: 9px 10px;font-size: 20px;"><span style="padding: 5px; font-size: 16px;" class="glyphicon glyphicon-ok"></span> Готов</a>
            </div>
            <?php else:?>
            <a href="#" style="cursor: default; color: #FFF; background: #e67e22; margin-right: 10px; margin-bottom: 10px; text-decoration:none; border-radius: 4px; padding: 9px 10px;font-size: 20px;"><span style="padding: 5px;font-size: 16px;" class="glyphicon glyphicon-remove"></span> Не готов</a>
            </div>
            <?php endif;?>
        <?php endif;?>
    </h1>
</div>