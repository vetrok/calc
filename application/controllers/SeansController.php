<?php
namespace application\controllers;

class SeansController implements ControllerAncestor
{
    /**
    *Свойство содержащее название HTML файла отрисовыввающего центральную часть страницы
     *
     */
    protected $_middleHTML = 'middleSeansIndex.php';
    protected $_meta = [];

    public function indexAction()
    {
        $front = FrontController::getInstance();
        $view = new \application\models\View();
        $front->setBody($view->render($this->getMiddleHTML(), null, $this->getMeta()));
    }

    /**
    *Метод для создания нового расчёта
     */
    public function newAction()
    {
        echo "<h1> CREATE action </h1>";
    }

    public function getMiddleHTML()
    {
        return $this->_middleHTML;
    }

    public function getMeta()
    {
        $this->_meta['topMenuClass'] = 'seans';
        return $this->_meta;
    }
}
