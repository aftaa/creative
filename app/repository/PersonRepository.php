<?php


namespace app\repository;

use app\entity\Person;
use app\service\Db;
use DateTime;
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
     * @throws \Exception
     */
    public function findAllAsObject(?int $limit, ?int $offset): array
    {
        $sql = "SELECT * FROM person";

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
                ->setCreatedAt(new DateTime($row['created_at']));
            $persons[$person->getId()] = $person;
        }

        (new PhoneRepository($this->app))->findAllAndAddPartnerPhones($persons);

        return $persons;
    }
}
