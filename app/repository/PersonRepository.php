<?php


namespace app\repository;

use app\entity\Person;

/**
 * Class PersonRepository
 * @package app\repository
 */
class PersonRepository
{
    private Db $db;

    /**
     * PersonRepository constructor.
     * @param Db $db
     */
    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    /**
     * @param Person $person
     * @return $this
     */
    public function add(Person $person): self
    {

    }
}
