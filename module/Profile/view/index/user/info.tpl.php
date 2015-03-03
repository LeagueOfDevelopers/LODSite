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
$vk_flag = !empty($vk) && ($user->getAccessLevel() >= 5 || $is_my_account);

$github = $profile_user->getGitHubReference();
$github_flag = !empty($github);

$phone = $profile_user->getPhoneNumber();
$phone_flag = !empty($phone) && ($user->getAccessLevel() >= 5 || $is_my_account);

$skype = $profile_user->getSkypeAccountName();
$skype_flag = !empty($skype) && ($user->getAccessLevel() >= 5 || $is_my_account);

$faculty = $profile_user->getFaculty();
$faculty_flag = !empty($faculty);

$group = $profile_user->getUniversityGroup();
$group_flag = !empty($group);

$course = $profile_user->getUniversityCourse();
$course_flag = !empty($course);

$register_date = $profile_user->getRegisterTime();
$register_date_flag = !empty($register_date);

$view_count = $profile_user->getViewCount();
$view_count_flag = true;

$sex = $profile_user->getViewSex();
$sex_flag = true;

$recent = $profile_user->getRecentActivityEllapsed();
$recent_flag = true;

$about = $profile_user->getAbout();
$about_flag = true;

$last_activity = $profile_user->getRecentActivityTime() ? 'Последняя активность '.$profile_user->getRecentActivityDate() : 'Еще не входил в свой аккаунт';
?>
<div class="panel panel-default">
    <div class="panel-heading">Основная информация</div>

    <table class="table">
        <tbody>
        <tr>
            <td><b>Сейчас</b></td>
            <td>
                <span data-toggle="tooltip" data-placement="right" title="" data-original-title="<?=$last_activity?>"><?=($profile_user->isOnline() ? 'Online' : 'Offline')?></span>
            </td>
        </tr>
        <tr>
            <td><b>Логин</b></td>
            <td><?=$profile_user->getNickName()?></td>
        </tr>
        <tr>
            <td><b>Имя, Фамилия</b></td>
            <td><?=$profile_user->getViewName()?></td>
        </tr>
        <tr>
            <td><b>Пол</b></td>
            <td><?=$sex?></td>
        </tr>
        <tr>
            <td><b>Дата регистрации</b></td>
            <td><?=$profile_user->getRegisterDate()?></td>
        </tr>
        <?php if (!$profile_user->isOnline()): ?>
            <tr>
                <td><b>Последняя активность</b></td>
                <td><?=$profile_user->getRecentActivityEllapsed()?></td>
            </tr>
        <?php endif; ?>
        <?php if ($vk_flag): ?>
            <tr>
                <td><b>Профиль ВКонтакте</b></td>
                <td><a target="_blank" href="<?=$vk?>"><?=$vk?></a></td>
            </tr>
        <?php endif; ?>
        <?php if ($phone_flag): ?>
            <tr>
                <td><b>Телефон</b></td>
                <td><?=$phone?></td>
            </tr>
        <?php endif; ?>
        <?php if ($skype_flag): ?>
            <tr>
                <td><b>Skype</b></td>
                <td><?=$skype?></td>
            </tr>
        <?php endif; ?>
        <?php if ($github_flag): ?>
            <tr>
                <td><b>Профиль GitHub</b></td>
                <td><a target="_blank" href="<?=$github?>"><?=$github?></a></td>
            </tr>
        <?php endif; ?>
        <?php if ($faculty_flag): ?>
            <tr>
                <td><b>Кафедра</b></td>
                <td><?=$faculty?></td>
            </tr>
        <?php endif; ?>
        <?php if ($group_flag): ?>
            <tr>
                <td><b>Группа</b></td>
                <td><?=$group?></td>
            </tr>
        <?php endif; ?>
        <?php if ($course_flag): ?>
            <tr>
                <td><b>Курс</b></td>
                <td><?=$course?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td><b>Количество просмотров профиля</b></td>
            <td><?=$profile_user->getViewCount()?></td>
        </tr>
        </tbody>
    </table>
</div>