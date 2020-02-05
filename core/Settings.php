<?php


namespace core;


class Settings
{
    use TSingletone;

    //Массив в который записываем параметры из файла  "config/params.php"
    private static $settings = [];


    public static function setSetting($name, $value)
    {
        self::$settings[$name] = $value;
    }

    public static function getSetting($name)
    {
        return self::$settings[$name] ?? null;
    }

    public static function readSettingFile()
    {
        $settings = require_once CONF . '/settings.php';
        if (!empty($settings)) {
            foreach ($settings as $name => $value) {
                self::setSetting($name, $value);
            }
        }
    }


}