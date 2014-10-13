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
$is_my_account = $user->isAuth() ? $profile_user->getId() == $user->getId() : false;

$vk = $profile_user->getVkProfileReference();
$vk_flag = !empty($vk);

$phone = $profile_user->getPhoneNumber();
$phone_flag = !empty($phone);
?>
<ul class="nav nav-pills">
    <li><a target="_blank" href="mailto:<?=$profile_user->getEmail()?>">Написать E-mail</a></li>
    <?php if ($is_my_account): ?>
        <li><a href="/edit">Редактировать</a></li>
    <?php endif; ?>
    <?php if ($vk_flag): ?>
        <li><a target="_blank" href="<?=$vk?>"><span class="glyphicon glyphicon-link"></span> Профиль в VK</a></li>
    <?php endif; ?>
    <?php if ($phone_flag): ?>
        <li><a><span class="glyphicon glyphicon-phone"></span><?=$phone?></a></li>
    <?php endif; ?>
</ul><div class="margin20"></div>