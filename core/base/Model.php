<?php


namespace core\base;


use core\Db;

class Model
{

    public $fields = [];

    protected $pdo;
    public $table;

    public function __construct()
    {
        $this->pdo = Db::instance();
    }


    public function execute($sql)
    {
        return $this->pdo->execute($sql);
    }

    /**
     * выводим все данные из любой таблицы/модели
     * @return arrayData
     */
    public function findAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql);
    }

    /**
     * Получить данные c учетом пагинации, и сортировки
     * @return mixed
     */
    public function getRecords($startRecord, $perPage, $sortData)
    {
        $order = "ORDER BY {$sortData['field']} ";
        $order .= (!empty($sortData['order'])) ? " DESC " : null;
        $sql = "SELECT * FROM {$this->table} {$order } LIMIT $startRecord, $perPage";
        return $this->pdo->query($sql);
    }


    /**
     * Количество записей в таблице
     * @return mixed
     */
    public function getCount()
    {
        $sql = "SELECT count(*) as `count` FROM {$this->table}";
        return $this->pdo->query($sql)[0]['count'] ?? null;
    }


    /**Получить одну запист по id
     * @param $id
     * @return mixed
     */
    public function findOne($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        return $this->pdo->query($sql, [$id])[0];
    }

    /**
     * Предварительно проставляем значения в поля модели(таблицы)
     * @param $data
     * @return mixed|null
     */
    public function loadData($data)
    {
        foreach ($this->fields as $key => $value) {
            if (isset($data[$key])) {
                $this->fields[$key] = h($data[$key]);
            }
        }
        return ($data['id']) ?? null;
    }

    /**
     * Вставка всех значений из массива "$this->fields"
     * в таблицу
     */
    public function insertData()
    {
        $fields = ''; //список полей
        $values = ''; //значение полей
        $params = []; //парметры для инекций
        foreach ($this->fields as $field => $value) {
            $fields .= "{$field},"; //формируем название полей
            $values .= ":{$field},";//значение полей
            $params[":{$field}"] = $value; //Защита от инекций
        }
        $fields = mb_substr($fields, 0, -1); //убираем запятую в конце
        $values = mb_substr($values, 0, -1);  //------------------------
        $sql = "INSERT INTO `{$this->table}` ({$fields}) VALUES ({$values})";
        return $this->pdo->execute($sql, $params);
    }

    /**Обновление записей в таблице
     * @param $id
     * @return bool
     */
    public function saveData($id)
    {
        if (empty($id)) {
            return false;
        }
        $params = [];
        $sql = "UPDATE {$this->table} SET ";
        foreach ($this->fields as $field => $value) {
            $sql .= "`{$field}` = :{$field},";
            $params[":{$field}"] = $value; //Защита от инекций
        }
        $sql = mb_substr($sql, 0, -1);
        $sql .= " WHERE id = :id";
        $params[':id'] = $id;
        return $this->pdo->execute($sql, $params);
    }


    /**Возвращаем поля для сортировки и порядок сортировки
     * @return array
     */
    public function getSortData()
    {
        $field = $_GET['sort'] ?? 'name';
        $order = $_GET['order'] ?? null;
        return [
            'field' => $field,
            'order' => $order
        ];
    }


}