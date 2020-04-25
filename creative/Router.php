<?php


namespace creative;

use Exception;

/**
 * Class Router
 * @package creative
 */
class Router
{
    /**
     * @param ViewLayout $viewLayout
     */
    public function route(ViewLayout $viewLayout)
    {
        $route = $this->detectRoute();
        $filename = $route ?: 'index';
        $filename .= '.php';
        $viewLayout->capture($filename);
    }

    /**
     * @return string
     */
    private function detectRoute(): string
    {
        $route = $_SERVER['REQUEST_URI'];
        $route = preg_replace('/\?.*$/', '', $route);
        $route = trim($route, '/');
        return $route;
    }
}
