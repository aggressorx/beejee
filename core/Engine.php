<?php


namespace core;


class Engine
{
    public static $setting;

    public function __construct()
    {
        session_start();
        //получили текущий url
        $url = trim($_SERVER['QUERY_STRING'], '/');
        //Считали настройки из файла "config/settings.php"
        //и поместили в переменную setting
        self::$setting = Settings::instance();
        self::$setting::readSettingFile();
        self::$setting::setSetting('url', $url);
        //Разбираем url и запускаем необходимый Class Action
        Router::dispatch($url);
    }

}