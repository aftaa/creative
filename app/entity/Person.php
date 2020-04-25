<?php


namespace app\entity;

/**
 * Class Person
 * @package app\entity
 */
class Person
{
    private string $firstName;
    private string $lastName;
    private string $middleName;
    /** @var array Phone[] */
    private array $phones = [];

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
     * @param Phone[] $phones
     * @return Person
     */
    public function setPhones(array $phones): Person
    {
        $this->phones = $phones;
        return $this;
    }
}
