<?php
namespace application\controllers;

class FrontController
{
    use Singleton;

    protected $_controller = '';
    protected $_action = '';
    protected $_params = [];
    /**
    *Служебный массив :
     * classHead = класс для отображения затемненного выбранного меню в шапке сайта
     * [seans, smena]
     *
     **/
    protected $_meta = [];
    protected $_body = '';
    protected function __construct()
    {
        /**
        *Чистим Query_string + удаляю первый и последний '/' + бью в массив
         */
        $query = trim(strtolower(strip_tags($_SERVER['REQUEST_URI'])), '/');
        $arr = explode('/', $query);
        /**
        *Выбираю какой контроллер\метод использовать , забиваю массив переменных
         */
        if ($arr[0] == 'seans') {
            $this->_controller = '\\' . __NAMESPACE__ . '\SeansController';
        } elseif ($arr[0] == 'smena') {
            $this->_controller = '\\' .  __NAMESPACE__ . '\SmenaController';
        } else {
            $this->_controller = '\\' . __NAMESPACE__ . '\IndexController';
        }
        if ($arr[1] == 'create') {
            $this->_action = 'createAction';
        } elseif ($arr[1] == 'show') {
            $this->_action = 'showAction';
        } else {
            $this->_action = 'indexAction';
        }
        for ($i = 2; $arr[$i]; $i += 2) {
            $this->_params[$arr[$i]] = $arr[$i + 1];  
        }
    }
    /**
    *Создаю обьект и вызываю его метод с проверками!
     */
    public function route()
    {
        try {
            if (class_exists($this->getController())) {
                $cont = new $this->_controller();
                if ($cont instanceof ControllerAncestor) {
                    if(method_exists($cont, $this->getAction())) {
                        $cont->{$this->getAction()}();
                    } else {
                        throw new \Exception('There is no such method!');
                    }
                } else {
                    throw new \Exception('Not an instanco OF interface');
                }
            } else {
                throw new \Exception('Class Doesnt exists');
            }
        } catch (\Exception $e) {
            $err = "Файл: ".__FILE__.
                ". Строка: ".__LINE__.
                ". Исключительная ситуация - ".$e->getMessage();
            trigger_error($err);
            die;
        }
    }
    public function getController()
    {
        return $this->_controller;
    }
    public function getAction()
    {
        return $this->_action;
    }
    public function getBody(){
        return $this->_body;
    }
    public function getMeta(){
        return $this->_meta;
    }
    public function getParams(){
        return $this->_params;
    }
    public function setBody($val){
        $this->_body = $val;
    }
}
