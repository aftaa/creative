<?php


namespace creative;

use creative\interfaces\ServiceInterface;
use Exception;
use stdClass;

/**
 * Class ServiceLocator
 * @package creative
 */
class ServiceLocator
{
    private stdClass $app;

    /** @var ServiceInterface[] */
    private array $services;

    public function __construct(stdClass $app)
    {
        $this->app = $app;
    }

    /**
     * @throws Exception
     */
    public function locateService(): void
    {
        foreach ($this->app->config['services'] as $serviceName => $params) {
            $service = new $params['class'];

            if ($service instanceof ServiceInterface) {
                $service->init($params['params'] ?? []);
                $this->app->$serviceName = $service;
            } else {
                throw new Exception("Class $params[class] isn't instance of ServiceInterface");
            }
        }
    }
}
