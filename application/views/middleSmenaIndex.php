<?php
    echo "<div class='header'>Калькулятор Смен</div>\n";
?>
<div class="content">
    <span>
        Данный калькулятор предназначен для расчета рабочих\выходных дней,
        чтобы увидеть когда в будущем будет выходной или рабочий день.
    </span>
<form action = <?php echo \application\controllers\Def::getSmenaCreate();?> method='POST' class='sm'>
    <span>
        Выберите график работы : <br>
        Например 3 через 3
    </span>
    <hr>
    <span>Количество рабочих дней</span>
    <br>
    <select name="work">
        <?php
        /**
         *Отрислвываем форму для ввода данных
         * График работы + дата первого рабочего дня по графику
         *начинаем с первого дня и месяца
         *Года отрисоваваем +-5
         */
        $work = 7;
        $rest = 7;
        for ($i = 1; $i <= $work; $i++) {
            echo "<option value=$i>$i";
        }
        ?>
    </select><hr>
    <span>Количество выходных</span>
    <br>
    <select name="rest">
        <?php
        for ($i = 1; $i <= $rest; $i++) {
            echo "<option value=$i>$i";
        }
        ?>
    </select><hr>
    <?php
    $day = 1;
    $month = 1;
    $yearStep = 5;
    $yearStart = (int)$data['year'] - $yearStep;
    $yearEnd = (int)$data['year'] + $yearStep;
    echo "<span>Выберите ваш первый рабочий день смены</span><br>";
    echo "<select name='day'>";
    while ($data['days']--) {
        if ($day == $data['day']) {
            echo "<option value=$day selected>$day</option>";
            $day++;
            continue;
        }
        echo "<option value=$day>$day</option>";
        $day++;
    }
    echo "</select><hr>";

    echo "<span>Выберите месяц</span><br>";
    echo "<select name='month'>";
    while ($month != 13) {
        if ($month == $data['month']) {
            echo "<option name='month' value=$month selected>$month</option>";
            $month++;
            continue;
        }
        echo "<option name='month' value=$month>$month</option>";
        $month++;
    }
    echo "</select><hr>";

    echo "<span>Выберите год</span><br>";
    echo "<select name='year'>";
    while ($yearEnd != $yearStart++) {
        if ($yearStart == $data['year']) {
            echo "<option value='$yearStart' selected>$yearStart</option>";
            //$yearEnd++;
            continue;
        }
        echo "<option value='$yearStart'>$yearStart</option>";
        //$yearStart++;
    }
    echo "</select><hr>";
    ?>

    <!--input type="submit" name="submit"-->
    <button type="submit">Отправить</button>
</form>
