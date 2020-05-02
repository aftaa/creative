<?php

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
                'username' => 'creative',
                'password' => 'creative',
                'database' => 'creative',
            ],
        ],

        'jsonResponse' => [
            'class' => \app\service\JsonResponse::class,
        ],

    ],
];
