<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$user = $this->getData()['user'];
/**
 * @var $user \Lod\User\User
 */
$users = $this->getData()['users']['users_list'];
?>
<?php
$this->includeModuleView('users.pagination');
?>
<table class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Логин</th>
        <th>E-mail</th>
        <th>Группа</th>
        <th>Дата регистрации</th>
        <th>Последняя активность</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php /** @var \Lod\User\User $user_item */
        foreach ($users as $user_item): ?>
            <?php
            $category = \Lod\User\Settings\UserCategories::defineCategoryName($user_item->getAccessLevel());
            $background = \Lod\User\Settings\UserCategories::defineCategoryBackground($user_item->getAccessLevel());
            $color = \Lod\User\Settings\UserCategories::defineCategoryColor($user_item->getAccessLevel());
            ?>
            <tr<?=$user_item->isBan() ? ' class="danger"' : ''?>>
                <td><?=$user_item->getId()?></td>
                <td><a target="_blank" href="/profile?id=<?=$user_item->getId()?>"><?=$user_item->getViewName()?></a></td>
                <td>
                    <a href="#" onclick="Admin.signInByUser(<?=$user_item->getId()?>); return !1;" data-toggle="tooltip" data-placement="left" title="Войти на сайт под этим пользователем">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </a>
                    <?=$user_item->getNickName()?>
                </td>
                <td><a target="_blank" href="mailto:<?=$user_item->getEmail()?>"><?=$user_item->getEmail()?></a></td>
                <td>
                    <span class="label" style="background: <?=$background?>; color: <?=$color?>;">
                        <a href="/adminium/users?act=edit&id=<?=$user_item->getId()?>" data-toggle="tooltip" data-placement="right" title="Редактировать">
                            <span class="glyphicon glyphicon-pencil" style="color: #fff;"></span>
                        </a>
                        <?=$category?>
                    </span>
                </td>
                <td><?=$user_item->getRegisterDate()?></td>
                <td><?=$user_item->getRecentActivityDate()?></td>
                <td>
                    <a target="_blank" href="/profile?id=<?=$user_item->getId()?>" data-toggle="tooltip" data-placement="right" title="Профиль">
                        <span class="glyphicon glyphicon-info-sign"></span>
                    </a>
                    <?php if (!$user_item->isBan()):?>
                        <a href="#" onclick="Admin.toggleBan(<?=$user_item->getId()?>); return !1;" data-toggle="tooltip" data-placement="left" title="Заблокировать">
                            <span class="glyphicon glyphicon-ban-circle"></span>
                        </a>
                    <?php endif; ?>
                    <?php if ($user_item->isBan()):?>
                        <a href="#" onclick="Admin.toggleBan(<?=$user_item->getId()?>); return !1;" data-toggle="tooltip" data-placement="left" title="Разблокировать">
                            <span class="glyphicon glyphicon-refresh"></span>
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
$this->includeModuleView('users.pagination');
?>