<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$types = \Lod\Orders\OrderTypes::$types;
?>
<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-6">

        <div class="page-header">
            <h1>Оформление заказа <small></small></h1>
        </div>

        <form class="form-horizontal" id="orderForm" method="post" action="/orders/add_order" enctype="multipart/form-data">

            <div class="form-group">
                <label class="col-lg-3 control-label">ФИО</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="name" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">E-mail</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="text" class="form-control" name="email" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Телефон</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                        <input type="text" class="form-control" name="phone" placeholder="" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Тип заказа</label>
                <div class="col-md-8">
                    <select class="form-control" name="type">
                        <option value="-1">-- Выберите --</option>
                        <?php foreach ($types as $name => $val): ?>
                            <option value="<?=$name?>"><?=$val?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Дедлайн</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input type="text" class="form-control" name="deadline" placeholder="Например, <?=date("d.m.Y", time() + 60 * 60 * 24 * 14)?>" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Прикрепления</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-paperclip"></span></span>
                        <input type="file" class="form-control" name="attachment" placeholder="Скриншоты, описание проекта и т. д." />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Подробное описание заказа</label>
                <div class="col-md-8">
                    <textarea class="form-control" name="description" rows="9"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"></label>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Отправить заказ</button>
                </div>
            </div>
        </form>

    </div>

    <div class="col-xs-6" style="padding-top: 115px;">

        <div>
            <strong><h4>Указания и рекомендации по размещению:</h4></strong>
            <br>

            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                Курсовые работы
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            Лига Разработчиков не занимается выполнением курсовых и дипломных работ. Причиной этому является отсутствие в подобной деятельности командной составляющей. Тем не менее, вы можете просмотреть портфолио наших разработчиков и лично обратиться за помощью к кому-либо из них.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                Рассмотрение заказа
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            После нажатия кнопки "Отправить" заказ отправляется на рассмотрение менеджеру организации. Менеджер постарается подобрать для заказа разработчиков и его успех в этом деле напрямую зависит от условий, которые вы ставите. Вы будете оповещены, когда работа над вашим заказом начнётся.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                Оплата
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            Вопросы оплаты обсуждаются индивидуально с менеджером. Заказ может быть выполнен бесплатно, если он имеет какую-либо академическую ценность.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                Гарантии
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                            Члены нашей организации присутствуют в ней добровольно в образовательных целях, они не связаны никакими трудовыми договорами, поэтому выполнение работы не гарантируется. В случае невыполнения заказа в срок, вам будут предложены альтернативы, но Лига стремится минимизировать количество таких эксцессов.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>