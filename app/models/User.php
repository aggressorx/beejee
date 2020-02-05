<?php


namespace app\models;


use core\base\Model;

class User extends Model
{
    public $table = 'users';

    public function login()
    {

        $login = !empty(trim($_POST['login'])) ? trim($_POST['login']) : null;
        $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;
        if (!$login || !$password) {
            return ['status' => 'empty'];
        }
        if ($login && $password) {
            $user = $this->pdo->query("SELECT * FROM {$this->table} WHERE login = :login ", [':login' => $login]);
            if ($user) {
                if ($password === $user[0]['password']) {
                    foreach ($user[0] as $k => $v) {
                        if ($k != 'password') {
                            $_SESSION['user'][$k] = $v;
                        }
                    }
                    return ['status' => 'success'];
                }
            }
        }
        return ['status' => 'wrong'];
    }

    public static function logout()
    {
        unset($_SESSION['user']);
    }

    public static function isAdmin(){
        return (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin');
    }

}