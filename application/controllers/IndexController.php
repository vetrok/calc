<?php
namespace application\controllers;

/**
 *Индексный отправляет на рендерринг middleIndex.php
 */
class IndexController implements ControllerAncestor
{
    protected $_middleHTML = 'middleIndex.php';

    public function indexAction()
    {
        /**
        *Получаю FrontController чтобы ему передать Боди ,
         * и взять массив параметров который у него(Синглтон круть!)
         * Беру параметры из модели(как бы из БД) и пердаю на рендеринг
         * View
         */
        $front = FrontController::getInstance();
        $view = new \application\models\View();
        $model = new \application\models\Main();
        $news = $model->getNews();
        $front->setBody($view->render($this->getMiddleHTML(), $news));
    }

    public function getMiddleHTML()
    {
        return $this->_middleHTML;
    }
}
