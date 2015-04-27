<?php
namespace application\models;

/**
 *Класс для рендеринга HTML включяет верхню часть , нижнюю , и изменяемую центральную,
 * Директории указаны полным путём ибо исполняются в index.php можно былобы и
 * относительные от того(index.php) файла...
 *
 * Записки из будущего - зачем этим занимается модель? это всё делается во воюхе...
 */
class View
{
    public function render($middle, $data = null, $meta = null)
    {
        ob_start();
        require(dirname(__DIR__) . '/views/top.php');
        require(dirname(__DIR__) . '/views/' . $middle);
        require(dirname(__DIR__) . '/views/bottom.php');
        return ob_get_clean();
    }
}
