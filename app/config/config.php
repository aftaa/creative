<?php

error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', '1');

return [
    'title' => 'Телефонный справочник',

    'phone_number_format' => '+7 XXX XXX-XX-XX',

    'layout_path' => 'app/layout',
    'layout'      => '/sticky.php',

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
