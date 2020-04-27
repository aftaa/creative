<?php


namespace app\entity;

use DateTime;
use Exception;

/**
 * Class Phone
 * @package app\entity
 */
class Phone
{
    private int $id;
    private string $phone;
    private DateTime $createdAt;

    /**
     * Phone constructor.
     * @param string $phone
     * @param int|null $id
     * @throws Exception
     */
    public function __construct(string $phone, ?int $id)
    {
        $this->setPhone($phone);
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Phone
     */
    public function setId(?int $id): Phone
    {
        $this->id = $id;
        return $this;
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
            throw new Exception("Phone number must have length 10.");
        }
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return Phone
     */
    public function setCreatedAt(DateTime $createdAt): Phone
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
