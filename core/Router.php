<?php


namespace core;


class Router

{
    protected static $routes = [];
    protected static $route = [];

    /**
     * Добавляем регулярки роуторв из файла routes.php
     * @param $regexp
     * @param array $route
     */
    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    /**
     * Проверяем есть соотвествие текущего url для заданных шаблонов
     * @param $url
     * @return bool
     */
    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#{$pattern}#", $url, $matches)) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (empty($route['action'])) {
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    /**
     * Если найдено соответсвтие matchRoute
     * то определяем необходимый класс который нужно запустить и action
     * @param $url
     * @throws \Exception
     */
    public static function dispatch($url)
    {
        $url = self::getQueryString($url);
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['controller'] . 'Controller';
            if (class_exists($controller)) {
                $controllerObject = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']).'Action';
                if (method_exists($controllerObject, $action)) {
                    call_user_func(array($controllerObject, $action));
                } else {
                    throw new \Exception("Метод $controller::$action не найден", 404);
                }
            } else {
                throw new \Exception("Контроллер $controller не найден", 404);
            }
        } else {
            throw new \Exception("Страница не найдена", 404);
        }
    }


    /**
     * Вырезаем  и взовращаем строку до GET параметров
     * @param $url
     * @return string
     */
    protected static function getQueryString($url)
    {
        if ($url) {
            $params = explode('&', $url);
            if (false === strpos($params[0], '=')) {
                return rtrim($params[0], '/');
            } else {
                return '';
            }
        }
    }


    // CamelCase первая буква заглавная
    protected static function upperCamelCase($name)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    // camelCase первая буква прописная
    protected static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }

}