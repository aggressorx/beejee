<?php


namespace app\controllers;


use app\models\Task;
use app\models\User;
use core\base\Controller;

class TaskController extends Controller
{
    public function addAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $taskModel = new Task();
            $data = $_POST;
            //Записываем в массив с поляеми значения полей
            $taskModel->loadData($data);
            if ($taskModel->insertData()) {
                textSession('Задание успешно добавлено');
            } else {
                textSession('Не удалост добавить задание', 'error');
            }
            header("Location: /");
            die();
        }
        $this->loadView();
    }

    public function editAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Проверяем что на этапе правки задания
            //админ залогинен
            if (User::isAdmin()) {
                $taskModel = new Task();
                $data = $_POST;
                //Записываем в массив с поляеми значения полей
                $taskModel->loadData($data);
                //Проверяем менялся ли основной текст
                $taskModel->compareText($data);
                if ($taskModel->saveData((int)$data['id'])) {
                    textSession('Данные успешно сохранены');
                } else {
                    textSession('Не удалост сохранить данные', 'error');
                }
            }
            header("Location: /");
            die();
        }
        $id = (int)$_GET['id'] ?? null;
        if (!$id || !User::isAdmin()) {
            header("Location: /");
            die();
        }
        $taskModel = new Task();
        $arResult['data'] = $taskModel->findOne($id);
        $this->loadView(compact('arResult'));


    }

}