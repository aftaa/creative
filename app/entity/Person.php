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
     * @param string $lastName
     * @return Person
     */
    public function setLastName(string $lastName): Person
    {
        $this->lastName = $lastName;
        return $this;
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
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getMiddleName(): string
    {
        return $this->middleName;
    }
}
