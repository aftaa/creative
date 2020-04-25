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
    private Person $person;

    /**
     * Phone constructor.
     * @param int $phone
     */
    public function __construct(int $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param PhoneFormatter $formatter
     * @return string
     */
    public function getPhone(PhoneFormatter $formatter): string
    {
        return $formatter->format($this);
    }
}
