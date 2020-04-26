<?php

/** @var stdClass $app */

use app\entity\Person;
use app\repository\PersonRepository;

$app->config['title'] = 'Внесение абонентов';

$personRepository = new PersonRepository($app->db);

$persons = file_get_contents('init/data/persons.txt');
$persons = explode("\n", $persons);
foreach ($persons as $person) {
    $person = preg_replace('/ +/', ' ', $persons);
    [$lastName, $firstName, $middleName] = explode(' ', $persons);

    $person = (new Person)
        ->setFirstName($firstName)
        ->setLastName($lastName)
        ->setMiddleName($middleName);

    $personRepository->add($person);
}

