<?php


namespace creative;

use stdClass;

/**
 * Class ServiceLocator
 * @package creative
 */
class ServiceLocator
{
    public function init(stdClass $app)
    {
        if (!empty($app->config['services'])) {
            $services = $app->config['services'];


        }
    }
}