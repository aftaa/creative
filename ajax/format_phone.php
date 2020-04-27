<?php

/** @var stdClass $app */

use app\entity\Phone;
use app\helper\PhoneNumberFormatterHelper;

$app->config['layout'] = 'blank.php';
$format = $app->config['phone_number_format'];

$phone = (new PhoneNumberFormatterHelper($format))->format(new Phone($_GET['phone']));

$app->jsonResponse->init([
    'phone' => $phone,
])->sent();