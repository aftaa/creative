<?php


namespace app\entity;

use Exception;

/**
 * Class Phone
 * @package app\entity
 */
class Phone
{
    private string $phone;

    /**
     * Phone constructor.
     * @param string $phone
     * @throws Exception
     */
    public function __construct(string $phone)
    {
        $this->setPhone($phone);
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return $this
     * @throws Exception
     */
    public function setPhone(string $phone): Phone
    {
        if (10 != strlen($phone)) {
            throw new Exception("Phone number must length 10.");
        }
        $this->phone = $phone;
        return $this;
    }
}
