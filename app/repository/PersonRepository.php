<?php


namespace app\repository;

use app\entity\Person;
use app\service\Db;
use DateTime;
use Exception;
use PDO;


/**
 * Class PersonRepository
 * @package app\repository
 */
class PersonRepository
{
    private Db $db;
    private object $app;

    /**
     * PersonRepository constructor.
     * @param Db $db
     * @param object|null $app
     */
    public function __construct(Db $db, ?object $app)
    {
        $this->db = $db;
        $this->app = $app;
    }

    /**
     * @return int
     */
    public function howMuch(): int
    {
        $sql = "SELECT COUNT(*) FROM person";
        $stmt = $this->db->dbh->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
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
     * @param int|null $limit
     * @param int|null $offset
     * @return Person[]|array
     * @throws Exception
     */
    public function findAllAsObject(?int $limit, ?int $offset): array
    {
        $sql = "SELECT * FROM person ORDER BY created_at DESC";

        if ($limit) {
            $sql .= " LIMIT $limit OFFSET $offset ";
        }
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
                ->setLastName($row['last_name'])
                ->setCreatedAt(new DateTime($row['created_at']))
                ->addPhones((new PhoneRepository($this->app))->findPersonPhones($row['id']));

            ;

            $persons[$person->getId()] = $person;
        }

//        $persons = (new PhoneRepository($this->app))->findAllAndAddPartnerPhones($persons);

        return $persons;
    }

    /**
     * @param Person $person
     * @return string
     */
    public function pushPerson(Person $person)
    {
        $sql = "INSERT INTO person SET first_name=?,last_name=?,middle_name=?";
        $stmt = $this->db->dbh->prepare($sql);
        $stmt->execute([
            $person->getFirstName(),
            $person->getLastName(),
            $person->getMiddleName()
        ]);
        return $this->db->dbh->lastInsertId();
    }

    /**
     * @param string $words
     * @return Person[]
     * @throws Exception
     */
    public function findWords(string $words): array
    {
        $sql = "SELECT * FROM `person` JOIN phone ON person_id=person.id" .
            "WHERE MATCH (first_name,last_name,middle_name) AGAINST '$words'";
        $stmt = $this->db->dbh->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        echo '<pre>'; print_r($rows); echo '</pre>'; die;

        /** @var Person[] $persons */
        $persons = [];
        foreach ($rows as $row) {
            $person = (new Person)
                ->setId($row['id'])
                ->setFirstName($row['first_name'])
                ->setMiddleName($row['middle_name'])
                ->setLastName($row['last_name'])
                ->setCreatedAt(new DateTime($row['created_at']));
            $persons[$person->getId()] = $person;
        }

        return $persons;
    }
}
