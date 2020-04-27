<?php


namespace app\manager;

use app\repository\PhoneRepository;

/**
 * Class PhoneManager
 * @package app\manager
 */
class PhoneManager
{
    private object $app;

    /**
     * PhoneManager constructor.
     * @param object $app
     */
    public function __construct(object $app)
    {
        $this->app = $app;
    }

    /**
     * @param string $number
     * @param int $limit
     * @param int $offset
     */
    public function searchPhone(string $number, int $limit, int $offset)
    {
        return (new PhoneRepository($this->app))->searchPersonsWithPhone
        ($number, $limit, $offset);
    }
}