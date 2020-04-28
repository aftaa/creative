<?php


namespace app\service;


use PDO;

class Db implements \creative\interfaces\ServiceInterface
{
    public PDO $dbh;

    /**
     * @param array $params
     * @return $this
     */
    public function init(array $params = []): self
    {
        $this->params = $params;
        $dsn = "mysql:dbname=$params[database];host=$params[hostname]";
        try {
            $this->dbh = new PDO($dsn, $params['username'], $params['password']);
			$this->dbh->prepare('SET NAMES UTF8')->execute();
        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }
        return $this;
    }
}
