<?php


namespace app\repository;


use app\entity\Person;
use app\entity\Phone;
use app\service\Db;
use DateTime;
use Exception;

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
        if ($number[0] == 7) {
            $number = substr($number, 1, 10);
        }

        $sql = "SELECT * FROM phone JOIN person ON person_id=person.id ";
        $sql .= " WHERE phone LIKE '%$number%' ORDER BY person.created_at DESC";
        if ($limit) {
            $sql .= " LIMIT $limit OFFSET $offset ";
        }

        $stmt = $this->db->dbh->prepare($sql);
        $stmt->execute();
        //echo '<pre>'; print_r($stmt->errorInfo()); echo '</pre>';
        $rows = $stmt->fetchAll();
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

        $sql = "SELECT id, phone, person_id FROM phone WHERE person_id IN($personsId)";
        $stmt = $this->db->dbh->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        foreach ($persons as $person) {
            foreach ($rows as $row) {
                if ($row['person_id'] == $person->getId()) {
                    $phone = new Phone($row['phone'], $row['id']);
                    $person->addPhone($phone);
                }
            }
        }

        return $persons;
    }
}
