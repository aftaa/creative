<?php


namespace app\service;


use PDO;

class Db implements \creative\interfaces\ServiceInterface
{
    private PDO $dbh;

    /**
     * @param array $params
     */
    public function init(array $params)
    {
        $this->params = $params;
        $dsn = "mysql:dbname=$params[database];host=$params[hostname]";
        try {
            $this->dbh = new PDO($dsn, $params['username'], $params['password']);
        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }
    }
}