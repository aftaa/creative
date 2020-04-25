<?php

error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', '1');

return [
    'title' => 'Телефонный справочник',

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
    ],
];
