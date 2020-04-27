<?php


namespace creative\interfaces;

/**
 * Interface ServiceInterface
 * @package creative\interfaces
 */
interface ServiceInterface
{
    /**
     * @param array $params
     * @return $this
     */
    public function init(array $params = []): self;
}
