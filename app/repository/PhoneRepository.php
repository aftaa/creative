<?php


namespace app\repository;


use app\entity\Person;
use app\entity\Phone;
use app\service\Db;

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

//                if ($stmt->errorCode()) {
//                    print_r($stmt->errorInfo());
//                    die;
//                }
            }
        }
    }
}
