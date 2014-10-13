<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$profile_user = $this->getData()['profile_user'];
/**
 * @var $profile_user \Lod\User\User
 */
?>
<div class="page-header">
    <h1>
        <?=$profile_user->getViewName()?>&nbsp;
        <small title="Идентификатор пользователя">#<?=$profile_user->getId()?></small>&nbsp;
        <?php if ($profile_user->isOnline()): ?>
            <small class="text-success" title="Сейчас на сайте">Online</small>
        <?php else: ?>
            <small title="<?=$profile_user->getRecentActivityEllapsed()?>" class="text-danger">Offline</small>
        <?php endif ?>
    </h1>
</div>