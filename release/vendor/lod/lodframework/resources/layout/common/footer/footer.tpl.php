<?php
    $cur_year = date('Y');
    $since_year = 2014;
    $view_year = $cur_year == $since_year ? $cur_year : $since_year.'-'.$cur_year;
?>
<div class="footer">
    League of Developers — <?=$view_year?>.
    <div class="pull-right" style="display: inline-block;">
        <ul class="nav nav-pills">
            <li><a href="/about">О нас</a></li>
            <li><a href="/feedback">Обратная связь</a></li>
            <li><a target="_blank" href="/user/register">Подать заявку в Лигу</a></li>
            <li><a target="_blank" href="http://vk.com/leagueofdevelopers">Группа ВКонтакте</a></li>
        </ul>
    </div>
</div>