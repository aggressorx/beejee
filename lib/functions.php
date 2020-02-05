<?php

//коректное отображение массивов
function dd($arr)
{
    echo '<pre>' . print_r($arr, true) . '</pre>';
}


/**
 * Удаяем из url заданный параметр
 * @param $name
 * @return string
 */
function removeGetParam($name)
{
    $url = $_SERVER['REQUEST_URI'];
    preg_match_all("#filter=[\d,&]#", $url, $matches);
    if (count($matches[0]) > 1) {
        $url = preg_replace("#filter=[\d,&]+#", "", $url, 1);
    }
    $url = explode('?', $url);
    $uri = $url[0] . '?';
    if (isset($url[1]) && $url[1] != '') {
        $params = explode('&', $url[1]);
        foreach ($params as $param) {
            if (!preg_match("#{$name}=#", $param)) {
                $uri .= "{$param}";
            }
        }
    }
    return urldecode($uri);
}

//Добавление в сессию текста для отображения
function textSession($text = '', $mode = 'success')
{
    $text = $text . '<br>';
    (isset($_SESSION[$mode])) ? $_SESSION[$mode] .= $text : $_SESSION[$mode] = $text;
}

/**
 * Убираем спецсимволы html
 * @param $str
 * @return string
 */
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}