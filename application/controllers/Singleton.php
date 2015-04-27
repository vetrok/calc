<?php
namespace application\controllers;

trait Singleton
{
    static protected $instance = null;

    static public function getInstance()
    {
        if(false === (static::$instance instanceof static)){
            static::$instance = new static;
        }
        return static::$instance;
    }

    protected function __construct()
    {

    }

    protected function __clone()
    {

    }

    protected function __wakeup()
    {

    }

}