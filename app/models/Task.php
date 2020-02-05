<?php


namespace app\models;


use core\base\Model;

class Task extends Model
{
    public $table = "task";

    public $fields = [
        'name' => '',
        'email' => '',
        'task' => '',
        'status' => '0',
        'write_admin' => '0',
    ];

    //Сравниваем текст c формы и хранимый в БД
    public function compareText($data)
    {
        $oldData = $this->findOne((int)$data['id']);
        $res = strcmp($oldData['task'], $data['task']);
        if ($res) {
            $this->fields['write_admin'] = '1';
        }
    }
}