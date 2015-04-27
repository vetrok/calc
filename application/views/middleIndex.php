<?php
    echo "<div class='header'>Главная страница</div>\n";
    foreach ($data as $k=>$v) {
         echo "<div class='msg'>{$v}</div>\n";
    }
?>