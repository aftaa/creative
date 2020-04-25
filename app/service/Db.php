<?php


namespace app\service;


use PDO;

class Db implements \creative\interfaces\DbConnectionInterface
{

    /**
     * @inheritDoc
     */
    public function connect(string $host, string $user, string $pass, string $db): PDO
    {
        // TODO: Implement connect() method.
    }
}