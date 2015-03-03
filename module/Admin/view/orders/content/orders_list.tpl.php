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
        <th>действие</th>
    </tr>
    </thead>
    <tbody>
    <?php /** @var \Lod\Orders\OrderItem $order_item */
    $m = 0;
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
                <td><div class="bs-docs-example">
                <div class="accordion" id="accordion<?=$m?>">
                <div class="accordion-group">
                <div class="accordion-heading"><a class="accordion-toggle collapsed btn btn-small btn-success" href="#collapse<?=$m?>" data-toggle="collapse" data-parent="#accordion<?=$m?>">
                Описание
                </a></div>
                <div class="accordion-body collapse" id="collapse<?=$m?>" style="height: 0px;">
                <div class="accordion-inner"><?=$order_item->getDescription();?>
                </div>
                </div>
                </div>
                </div>
                </div></td>
                <?php $m++;?>
                <td><?=$order_item->getCreateDate()?></td>
                <td><?php if(($order_item->getStatus()) != 1): ?><a href="/adminium/approveOrder?id=<?=$order_item->getId() ?>&type=order" class="btn btn-mini btn-info" role="button" style = "margin-right:10px;"> Одобрить</a><?php else:?> Одобрено<?php endif;?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>