<?php


namespace mvc\creative;


/**
 * Class Kernel
 * @package mvc\creative
 */
class Kernel
{
    private array $config;

    /**
     * Kernel constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function run()
    {
        (new Router($this->config))->route();
    }
}
