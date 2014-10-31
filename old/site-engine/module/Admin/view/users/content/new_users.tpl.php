<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$user = $this->getData()['user'];
/**
 * @var $user \Lod\User\User
 */
$new_users = $this->getData()['users']['new_users'];
?>
<div class="row">
    <div class="col-xs-12">

        <div class="panel panel-default">
            <div class="panel-heading">Новые заявки в Лигу Разработчиков</div>

            <div class="margin20">
                <table class="table table-striped">
                    <?php if (count($new_users)): ?>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Логин</th>
                            <th>E-mail</th>
                        </tr>
                        </thead>
                    <?php endif; ?>
                    <tbody>
                    <?php /** @var \Lod\User\User $user_item */
                        foreach ($new_users as $user_item): ?>
                            <tr>
                                <td><?=$user_item->getId()?></td>
                                <td><?=$user_item->getViewName()?> (<a target="_blank" href="/profile?id=<?=$user_item->getId()?>">Заявка</a>)</td>
                                <td><?=$user_item->getNickName()?></td>
                                <td><a target="_blank" href="mailto:<?=$user_item->getEmail()?>"><?=$user_item->getEmail()?></a></td>
                                <td>
                                    <button class="btn btn-success btn-xs" onclick="Admin.userConfirm(<?=$user_item->getId()?>)">Принять</button>
                                    <button class="btn btn-danger btn-xs" onclick="Admin.toggleBan(<?=$user_item->getId()?>)">Отменить</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (!count($new_users)): ?>
                            <tr>
                                <td style="text-align: center;">Пока нет новых заявок</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>