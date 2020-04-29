<?php


namespace app\repository;


use app\entity\Person;
use app\entity\Phone;
use app\service\Db;
use DateTime;
use Exception;
use PDO;

class PhoneRepository
{
    private \stdClass $app;
    private Db $db;

    /**
     * PhoneRepository constructor.
     * @param \stdClass $app
     */
    public function __construct(\stdClass $app)
    {
        $this->app = $app;
        $this->db = $app->db;
    }

    /**
     * @param Phone $phone
     * @return bool
     */
    public function numberExists(Phone $phone): bool
    {
        $sql = "SELECT COUNT(*) FROM phone WHERE phone=:phone";
        $stmt = $this->db->dbh->prepare($sql);
        $stmt->execute([
            'phone' => $phone->getPhone(),
        ]);
        $count = $stmt->fetchColumn()[0];
        return (bool)$count;
    }

    /**
     * Init method.
     *
     * @param $persons Person[]
     */
    public function addPhones(array $persons)
    {
        set_time_limit(0);

        $sql = "INSERT INTO phone SET phone=?, person_id=?";
        $stmt = $this->db->dbh->prepare($sql);

        if ($stmt->errorCode()) {
            die($stmt->errorInfo());
        }

        foreach ($persons as $person) {
            foreach ($person->getPhones() as $phone) {
                $stmt->execute([
                    $phone->getPhone(),
                    $person->getId(),
                ]);
            }
        }
    }

    /**
     * @param $number
     * @param $limit
     * @param $offset
     * @return array
     * @throws Exception
     */
    public function searchPersonsWithPhone($number, $limit, $offset): array
    {
        $number = preg_replace('/[^0-9]/', '', $number);
        if ($number[0] == 7 && strlen($number) > 10) {
            $number = substr($number, 1, 10);
        }


        $sql = "SELECT * FROM phone JOIN person ON person_id=person.id ";
        $sql .= " WHERE phone LIKE '%$number%' ORDER BY person.created_at DESC";
        if ($limit) {
            $sql .= " LIMIT $limit OFFSET $offset ";
        }

        //echo $sql;

        $stmt = $this->db->dbh->prepare($sql);
        $stmt->execute();
        //echo '<pre>'; print_r($stmt->errorInfo()); echo '</pre>';
        $rows = $stmt->fetchAll();
//        echo '<pre>'; print_r($rows); echo '</pre>'; die;
        /** @var Person[] $persons */
        $persons = [];

        foreach ($rows as $row) {
            $person = (new Person())
                ->setId($row['id'])
                ->setFirstName($row['first_name'])
                ->setMiddleName($row['middle_name'])
                ->setLastName($row['last_name'])
                ->setCreatedAt(new DateTime($row['created_at']));
            $person->addPhone(new Phone($row['phone'], 0));
            $persons[] = $person;
        }
//        echo '<pre>'; print_r(($persons)); echo '</pre>'; die;

        return $persons;
    }

    /**
     * @param Person[] $persons
     * @return Person[]
     * @throws Exception
     */
    public function findAllAndAddPartnerPhones(array $persons)
    {
        $personsId = array_keys($persons);
        $personsId = join(',', $personsId);

        foreach ($persons as $person) {

            $phones = $this->findPersonPhones($person->getId());

            foreach ($phones as $phone) {
                $person->addPhone($phone);
            }

//            echo '<pre>'; print_r($person); echo '</pre>'; die;
        }

        return $persons;
    }

    /**
     * @param Phone $phone
     * @param int $personId
     * @return string
     */
    public function savePhone(Phone $phone, int $personId)
    {
        $stmt = $this->db->dbh->prepare('INSERT INTO phone SET phone=:phone, person_id=:person');
        $stmt->execute([
            'phone'  => $phone->getPhone(),
            'person' => $personId,
        ]);
        return $this->db->dbh->lastInsertId();
    }

    public function findPersonPhones(int $personId): array
    {
        $stmt = $this->db->dbh->prepare('SELECT * FROM phone WHERE person_id=:person_id');
        $stmt->execute([
            'person_id' => $personId,
        ]);

        /** @var Phone[] $phones */
        $phones = [];
        $all = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($all as $row) {
            $phone = new Phone($row['phone'], $personId);
            $phones[] = $phone;
        }
        return $phones;
    }
}
