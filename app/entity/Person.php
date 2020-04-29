<?php


namespace app\entity;

use DateTime;

/**
 * Class Person
 * @package app\entity
 */
class Person
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $middleName;
    private DateTime $createdAt;
    /** @var array Phone[] */
    private array $phones = [];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Person
     */
    public function setId(int $id): Person
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Person
     */
    public function setFirstName(string $firstName): Person
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Person
     */
    public function setLastName(string $lastName): Person
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getMiddleName(): string
    {
        return $this->middleName;
    }

    /**
     * @param string $middleName
     * @return Person
     */
    public function setMiddleName(string $middleName): Person
    {
        $this->middleName = $middleName;
        return $this;
    }

    /**
     * @return Phone[]
     */
    public function getPhones(): array
    {
        return $this->phones;
    }

    /**
     * @param Phone $phone
     * @return Person
     */
    public function addPhone(Phone $phone): Person
    {
        $this->phones[] = $phone;
        return $this;
    }

    /**
     * @param $phones
     * @return Person;
     */
    public function addPhones($phones)
    {
        $this->phones = $phones;
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
     * @return Person
     */
    public function setCreatedAt(DateTime $createdAt): Person
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
