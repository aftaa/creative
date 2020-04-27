<?php


namespace app\repository;

use app\entity\Person;
use app\helper\GeneratePhoneNumberHelper;
use app\service\Db;
use PDO;

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
     * @param Person[] $persons
     * @return $this
     */
    public function addPersons(array $persons): self
    {
//        return;

        $sql = "INSERT INTO person SET first_name=?, last_name=?, middle_name=?";
        $sth = $this->db->dbh->prepare($sql);

        foreach ($persons as $person) {
            $sth->execute([
                $person->getFirstName(),
                $person->getLastName(),
                $person->getMiddleName(),
            ]);
        }
    }

    /**
     * @return Person[]
     */
    public function findAllAsObject(): array
    {
        $sql = "SELECT * FROM person";
        $stmt = $this->db->dbh->prepare($sql);
        $stmt->execute();

        /** @var Person[] $persons */
        $persons = [];

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $person = (new Person)
                ->setId($row['id'])
                ->setFirstName($row['first_name'])
                ->setMiddleName($row['middle_name'])
                ->setLastName($row['last_name']);
            $persons[] = $person;
        }

        return $persons;
    }
}
