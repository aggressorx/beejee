<?php

namespace core;

class Db
{
    use TSingletone;

    protected $pdo;


    protected function __construct()
    {
        $db = require_once CONF . '/config_db.php';
        $options = [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];
        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass'], $options);
    }

    public function execute($sql, $params = [])
    {
        $smtp = $this->pdo->prepare($sql);
        return $smtp->execute($params);

    }

    public function query($sql, $params = [])
    {
        $smtp = $this->pdo->prepare($sql);
        $res = $smtp->execute($params);
        if ($res) {
            return $smtp->fetchAll();
        }
        return [];
    }

}