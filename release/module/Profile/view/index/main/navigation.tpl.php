<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$profile_user = $this->getData()['profile_user'];
/**
 * @var $profile_user \Lod\User\User
 */
?>
<ol class="breadcrumb">
    <li><a href="/">Главная</a></li>
    <li><a href="/profile">Профиль</a></li>
    <li class="active"><?=$profile_user->getViewName()?></li>
</ol>