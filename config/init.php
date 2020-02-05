<?php

define("ROOT", dirname(__DIR__));
define("WWW", ROOT . '/public');
define("CORE", ROOT . '/core');
define("APP", ROOT . '/app');
define("CONF", ROOT . '/config');
define("LIBS", ROOT . '/lib');


require_once ROOT . '/vendor/autoload.php';
require_once LIBS . '/functions.php';
require_once CONF . '/routes.php';

$app_path = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
$app_path = preg_replace("#[^/]+$#", '', $app_path);
define("PATH", $app_path);
