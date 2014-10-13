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

$email_flag = $user->getAccessLevel() >= 5 || $is_my_account;

$vk = $profile_user->getVkProfileReference();
$vk_flag = !empty($vk) && ($user->getAccessLevel() >= 5 || $is_my_account);

$phone = $profile_user->getPhoneNumber();
$phone_flag = !empty($phone) && ($user->getAccessLevel() >= 5 || $is_my_account);

$category_color = \Lod\User\Settings\UserCategories::defineCategoryColor($profile_user->getAccessLevel());
$category_name = \Lod\User\Settings\UserCategories::defineCategoryName($profile_user->getAccessLevel());
$category_background = \Lod\User\Settings\UserCategories::defineCategoryBackground($profile_user->getAccessLevel());

?>
<ul class="nav nav-pills">
    <li><a style="cursor: default; color: <?=$category_color?>; background: <?=$category_background?>;"><span class="glyphicon glyphicon-globe"></span> <?=$category_name?></a></li>
    <?php if ($email_flag): ?>
        <li><a target="_blank" href="mailto:<?=$profile_user->getEmail()?>"><span class="glyphicon glyphicon-send"></span> Написать E-mail</a></li>
    <?php endif; ?>
    <?php if ($vk_flag): ?>
        <li><a target="_blank" href="<?=$vk?>"><span class="glyphicon glyphicon-link"></span> Профиль в VK</a></li>
    <?php endif; ?>
    <?php if ($phone_flag): ?>
        <li><a><span><span class="glyphicon glyphicon-phone"></span> <?=$phone?></span></a></li>
    <?php endif; ?>
    <?php if ($is_my_account): ?>
        <li><a href="/edit"><span class="glyphicon glyphicon-pencil"></span> Редактировать</a></li>
    <?php endif; ?>
</ul><div class="margin20"></div>