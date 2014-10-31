<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$user = $this->getData()['user'];
/**
 * @var $user \Lod\User\User
 */
$last_activity = $user->getRecentActivityTime() ? 'Последняя активность '.$user->getRecentActivityDate() : 'Еще не входил в свой аккаунт';
?>
<div class="page-header">
    <h1>
        <?=$user->getViewName()?>&nbsp;
        <small title="Идентификатор пользователя">#<?=$user->getId()?></small>&nbsp;
        <?php if ($user->isOnline()): ?>
            <small class="text-success" data-toggle="tooltip" data-placement="right" title="" data-original-title="Сейчас на сайте">Online</small>
        <?php else: ?>
            <small class="text-danger" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?=$last_activity?>">Offline</small>
        <?php endif ?>
    </h1>
</div>