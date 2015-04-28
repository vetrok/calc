<?php
namespace application\controllers;

/**
*Класс оперделения путей файлов по http://
 */
class Def
{
    /**
    *Относительная директория проэкта
     */
    protected static $_projectAddr = '';
    /**
    *Адреса для файлов в html
     */
    protected static $_views = '';
    protected static $_controllers = '';
    protected static $_models = '';
    protected static $_styles = '';
    protected static $_images = '';
    /**
     *Навигация по сайту
    */
    protected static $_smena = '';
    protected static $_smenaCreate = '';
    protected static $_smenaShow = '';
    protected static $_seans = '';
    protected static $_seansCreate = '';
    protected static $_index = '';
    public static function getProjectAddr()
    {
        return static::$_projectAddr = '';
    }

    public static function getViews()
    {
        return static::$_views = 'http://' . $_SERVER['SERVER_NAME'] . static::getProjectAddr() . '/application/views/';
    }

    public static function getControllers()
    {
        return static::$_controllers = 'http://' . $_SERVER['SERVER_NAME'] . static::getProjectAddr() . '/application/controllers/';
    }

    public static function getModels()
    {
        return static::$_models = 'http://' . $_SERVER['SERVER_NAME'] . static::getProjectAddr() . '/application/views/';
    }

    public static function getStyles()
    {
        return static::$_styles = 'http://' . $_SERVER['SERVER_NAME'] . static::getProjectAddr() . '/styles/';
    }

    public static function getImages()
    {
        return static::$_images = 'http://' . $_SERVER['SERVER_NAME'] . static::getProjectAddr() . '/images/';
    }

    public static function getSmena()
    {
        return static::$_smena = 'http://' . $_SERVER['SERVER_NAME'] . static::getProjectAddr()  . '/smena/';
    }

    public static function getSmenaCreate()
    {
        return static::$_smena = 'http://' . $_SERVER['SERVER_NAME'] . static::getProjectAddr()  . '/smena/create/';
    }

    public static function getSmenaShow()
    {
        return static::$_smena = 'http://' . $_SERVER['SERVER_NAME'] . static::getProjectAddr()  . '/smena/show/';
    }

    public static function getSeans()
    {
        return static::$_seans = 'http://' . $_SERVER['SERVER_NAME'] . static::getProjectAddr() . '/seans/';
    }

    public static function getSeansCreate()
    {
        return static::$_seans = 'http://' . $_SERVER['SERVER_NAME'] . static::getProjectAddr() . '/seans/create/';
    }
    
    public static function getIndex()
    {
        return static::$_index = 'http://' . $_SERVER['SERVER_NAME'] . static::getProjectAddr() . '/';
    }
}
