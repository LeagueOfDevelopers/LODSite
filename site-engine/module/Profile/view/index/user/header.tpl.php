<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$profile_user = $this->getData()['profile_user'];
/**
 * @var $profile_user \Lod\User\User
 */
$last_activity = $profile_user->getRecentActivityTime() ? 'Последняя активность '.$profile_user->getRecentActivityDate() : 'Еще не входил в свой аккаунт';
?>
<div class="page-header">
    <h1>
        <?=$profile_user->getViewName()?>&nbsp;
        <small title="Идентификатор пользователя">#<?=$profile_user->getId()?></small>&nbsp;
        <?php if ($profile_user->isOnline()): ?>
            <small class="text-success" data-toggle="tooltip" data-placement="right" title="" data-original-title="Сейчас на сайте">Online</small>
        <?php else: ?>
            <small class="text-danger" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?=$last_activity?>">Offline</small>
        <?php endif ?>
    </h1>
</div>