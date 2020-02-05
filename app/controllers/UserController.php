<?php


namespace app\controllers;


use app\models\User;
use core\base\Controller;

class UserController extends Controller
{

    public function loginAction()
    {
        if ($this->isAjax()) {
            $userModel = new User();
            $statusAuth = $userModel->login();
            echo json_encode($statusAuth);
            die();
        }
    }

    public function logoutAction()
    {
        User::logout();
        header("Location: /");
        die();
    }


}