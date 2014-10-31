<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$user = $this->getData()['user'];
/**
 * @var $user \Lod\User\User
 */
$orders = $this->getData()['orders'];
?>
<table class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>ФИО</th>
        <th>E-mail</th>
        <th>Телефон</th>
        <th>Тип</th>
        <th>Дедлайн</th>
        <th>Вложение</th>
        <th>Описание</th>
        <th>Дата создания</th>
    </tr>
    </thead>
    <tbody>
    <?php /** @var \Lod\Orders\OrderItem $order_item */
    foreach ($orders as $order_item): ?>
            <?php
            $type_name = \Lod\Orders\OrderTypes::getNameById($order_item->getType());
            ?>
            <tr>
                <td><?=$order_item->getId()?></td>
                <td><?=$order_item->getFio()?></td>
                <td><a target="_blank" href="mailto:<?=$order_item->getEmail()?>"><?=$order_item->getEmail()?></a></td>
                <td><?=$order_item->getPhone()?></td>
                <td><?=$type_name?></td>
                <td>
                    <?php if ($order_item->getFinishTime()): ?>
                    <?=$order_item->getFinishDate()?>
                    <?php endif; ?>
                </td>
                <td>
                <?php if ($order_item->getFileLink()): ?>
                <a target="_blank" href="<?=$order_item->getFileLink()?>">Файл</a>
                <?php endif; ?>
                </td>
                <td><?=$order_item->getDescription()?></td>
                <td><?=$order_item->getCreateDate()?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>