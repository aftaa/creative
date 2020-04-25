<?php


namespace creative\interfaces;

use PDO;

/**
 * Interface DbConnectionInterface
 * @package creative\interfaces
 */
interface DbConnectionInterface
{
    /**
     * @param string $host
     * @param string $user
     * @param string $pass
     * @param string $db
     * @return PDO
     */
    public function connect(
        string $host,
        string $user,
        string $pass,
        string $db
    ): PDO;
}
