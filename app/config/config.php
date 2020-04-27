<?php

error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', '1');

if (file_exists(__DIR__ . '/config.local.php')) {
    return require_once __DIR__ . '/config.local.php';
}

return [
    'title' => 'Телефонный справочник',

    'phone_number_format' => '+7 XXX XXX-XX-XX',

    'layout_path' => 'app/layout',
    'layout'      => '/sticky.php',

    'person_data_filename' => 'init/data/persons.txt',

    'services' => [
        'db' => [
            'class'  => \app\service\Db::class,
            'params' => [
                'hostname' => 'localhost',
                'username' => 'usoafterya_creative',
                'password' => 'usoafterya_creative',
                'database' => 'usoafterya_creative',
            ],
        ],

        'jsonResponse' => [
            'class' => \app\service\JsonResponse::class,
        ],

    ],
];
