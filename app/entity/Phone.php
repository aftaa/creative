<?php


namespace app\entity;

use helper\PhoneFormatter;

/**
 * Class Phone
 * @package app\entity
 */
class Phone
{
    private int $phone;

    /**
     * Phone constructor.
     * @param int $phone
     */
    public function __construct(int $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getPhone(PhoneFormatter $format): string
    {
        return $format->format($this);
    }
}
