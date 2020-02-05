<?php


namespace app\controllers;


use app\models\Main;
use core\base\Controller;
use core\Engine;
use lib\Pagination;

class MainController extends Controller
{
    public function indexAction()
    {
        $mainModel = new Main();
        //Пагинация
        $countItems = $mainModel->getCount();  //Количество записей в выборке
        $perPage = Engine::$setting::getSetting('perPage');  //Количество записей на страницу
        $pagination = new Pagination($perPage, $countItems);
        $startRecord = $pagination->getStart();
        if ($countItems > $perPage) {
            $arResult['pagination'] = $pagination->getHtmlPagination();
        }


        //Удалили из url параметр sort
        $arResult['urlNoSort'] = removeGetParam('sort');
        //Считали из настроек поля с названиями для сортировки
        $arResult['sortFields'] = Engine::$setting::getSetting('sortFields');
        //Активное поле сортировки
        $arResult['sortFieldData'] = $mainModel->getSortData();
        //Основные записи из БД для отображения
        $arResult['data'] = $mainModel->getRecords($startRecord, $perPage, $arResult['sortFieldData']);
        $arResult['role'] = (!empty($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') ? 'admin' : null;
        $this->loadView(compact('arResult'));
    }

}