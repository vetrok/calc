<?php
namespace application\controllers;

/**
 *Класс для полезного\часто используемого функционала
 */
class Usefull
{
    public static function clearStr($str)
    {
        return trim(strip_tags($str));
    }

    public static function clearInt($int)
    {
        return abs((int)$int);
    }

    public static function serialize($arr)
    {
        return base64_encode(serialize($arr));
    }

    public static function unserialize($str)
    {
        return unserialize(base64_decode($str));
    }
}