<?php


namespace app\manager;

use app\entity\Person;
use app\repository\PersonRepository;

/**
 * Class PersonManager
 * @package app\manager
 */
class PersonManager
{
    private object $app;

    /**
     * PersonManager constructor.
     * @param object $app
     */
    public function __construct(object $app)
    {
        $this->app = $app;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Person[]|array
     * @throws \Exception
     */
    public function getPage(int $limit, int $offset)
    {
        return (new PersonRepository($this->app->db, $this->app))
            ->findAllAsObject($limit, $offset);
    }

    /**
     * @return string[]
     */
    public function initPersonTableFromFile()
    {
        $filename = $this->app->config['person_data_filename'];
        $personContent = file_get_contents($filename);
        $personRows = explode("\n", $personContent);

        /** @var Person[] $persons */
        $persons = [];

        foreach ($personRows as $personRow) {
            $personRow = preg_replace('/ +/', ' ', $personRow);
            [$lastName, $firstName, $middleName] = explode(' ', $personRow);

            $person = (new Person)
                ->setFirstName($firstName)
                ->setLastName($lastName)
                ->setMiddleName($middleName);
            $persons[] = $person;
        }

        return $personRows;
    }

}
