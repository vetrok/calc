<?php
namespace application\models;

/**
 *Модель тестовая 3 новости содержит для главной страницы
 */
class Main
{
    protected $_news = '';
    public function getNews(){
        $this->_news[0] = "Данный проект служит тестовой площадкой возможностей PHP. Основная задача которого - тестирование и применения шаблонов проектирования, на базе шаблона MVC. Если у вас есть предложения и замечания отправляйте их мне на почту : vetrok87@gmail.com";

        return $this->_news;

    }
}