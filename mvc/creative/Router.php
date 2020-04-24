<?php


namespace mvc\creative;

use Exception;

/**
 * Class Router
 * @package mvc\creative
 */
class Router
{
    private array $config;

    /**
     * Router constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     *
     */
    public function route()
    {
        $route = $_SERVER['REQUEST_URI'];
        $route = basename($route);
        $route = preg_replace('/\?.*$/', '', $route);
        $route = trim($route, '/');
        $config = $this->config;
        require_once "$route.php" ?? 'default.php';
    }
}
