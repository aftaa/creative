<?php


namespace creative;


/**
 * Class Kernel
 * @package creative
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

    /**
     *
     */
    public function run()
    {
        $app = (object)[
            'config' => &$this->config,
        ];

        new ServiceLocator($app);

        (new Router)->route(
            (new ViewLayout($app))
        );
    }
}
