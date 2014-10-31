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
$users_list = is_array($this->getData()['last_activity_users']) ? $this->getData()['last_activity_users'] : array();
?>
<ul class="list-group">
    <?php
    /** @var \Lod\User\User $cur_user */
    foreach ($users_list as $cur_user): ?>
        <li class="list-group-item">
            <a class="user-link" href="/profile?id=<?=$cur_user->getId()?>"><?=$cur_user->getViewName()?></a>
            <?php if ($cur_user->isOnline()): ?>
                <span class="online-pointer"></span>
                <span class="badge badge-lod-blue" data-toggle="tooltip" data-placement="left" title="Последняя активность <?=$cur_user->getRecentActivityDate()?>">На сайте</span>
            <?php endif; ?>
            <?php if (!$cur_user->isOnline()): ?>
                <span class="badge badge-lod-gray" data-toggle="tooltip" data-placement="left" title="Последняя активность <?=$cur_user->getRecentActivityDate()?>">Вне сети</span>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
    <?php if (!count($users_list)): ?>
        <li class="list-group-item">Список пуст</li>
    <?php endif; ?>
</ul>