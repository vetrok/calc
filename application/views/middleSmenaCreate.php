<!--Шаблон для отрисовки визуально массива с робочими\выходными данями-->
<?php
echo "<div class='header'>Калькулятор Смен</div>\n";
?>
<div class="content">
<div class="prev nav-fillpath">
    <!--a class="left" href=
    >Prev</a-->
    <a class="prev" href="
    <?php
    echo \application\controllers\Def::getSmenaShow() . \application\controllers\SmenaController::getMeta()['prev'] . '/1';
    ?>
    ">
            <span class="icon-wrap"></span>
            <h3><strong></strong> </h3>
        </a>

</div>
<div class="next nav-fillpath">
    <!--a class="right" href=
    >Next</a-->
    <a class="next" href="
    <?php
    echo \application\controllers\Def::getSmenaShow() . \application\controllers\SmenaController::getMeta()['next'] . '/1';
    ?>
    ">
        <span class="icon-wrap"></span>
        <h3><strong></strong> </h3>
    </a>
</div>
<div class ="calendar">
    <div class="weekdays"><?php
        echo date('m.Y', $data[0]);
        ?></div>
    <div class="weekdays">
        <div class='weekday'><span>Пн</span></div>
        <div class='weekday'><span>Вт</span></div>
        <div class='weekday'><span>Ср</span></div>
        <div class='weekday'><span>Чт</span></div>
        <div class='weekday'><span>Пт</span></div>
        <div class='weekday'><span>Сб</span></div>
        <div class='weekday'><span>Вс</span></div>
    </div>
<?php
$days = date('t', $data[0]);
/**
*Это порядковый номер деня недели , если он есть , то нужно столькоже дней - 1
 * нариовать пустыми! это условно дни недели если 1 число нашего месяца = 4
 * (четверг), то 3 дня должны быть пустыми
 */
$arr = $data[1];
//День месяца в timestamp пришедшем от пользователя
$day = date('j', $data[0]) - 1;
if ($day) {
    $step = 86400;
    $time = $data[0] - ($step * $day);
    $firstDay = date('N', $time) - 1;
}
$totalDays = $days + $firstDay;
$count = 0;
for ($i = 0; $totalDays; $totalDays--) {
    if (
        $count == 0 or
        $count == 7 or
        $count == 14 or
        $count == 21 or
        $count == 28 or
        $count == 35
    ) {
        echo "<div class='week'>";
    }
    if ($firstDay > 0) {
        echo "<div class='day'><span></span></div>";
        $firstDay--;
    } else {
        echo "<div class='day $arr[$i]'><span>" , $i + 1 , "</span></div>";
        $i++;
    }
    if (
        $count == 6 or
        $count == 13 or
        $count == 20 or
        $count == 27 or
        $count == 34 or
        $count == 41
    ) {
        echo "</div>";
    }
    $count++;
}
?>
    </div>
</div>