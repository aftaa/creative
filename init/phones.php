<?php

/** @var stdClass $app */

use app\helper\GeneratePhoneNumberHelper;
use app\repository\PersonRepository;
use app\repository\PhoneRepository;

$app->config['title'] = 'Внесение телефонов';

$persons = (new PersonRepository($app->db))->findAllAsObject();

(new GeneratePhoneNumberHelper)->gen($persons);

(new PhoneRepository($app))->addPhones($persons);

echo '<pre>'; print_r($persons); echo '</pre>'; die;