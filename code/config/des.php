<?php

$configPro = require_once __DIR__ . '/pro.php';

$configDes = [
    'database' => [
        'ComponentWriterDatabase' => [
            'engine'    => 'mysql',
            'hostname'  => 'sql',
            'username'  => 'root',
            'password'  => 'root',
            'database'  => 'components',
            'charset'   => 'utf8',
            'port'      => 3306
        ],
        'ComponentReaderDatabase' => [
            'engine'    => 'mysql',
            'hostname'  => 'sql',
            'username'  => 'root',
            'password'  => 'root',
            'database'  => 'components',
            'charset'   => 'utf8',
            'port'      => 3306
        ]
    ]
];

return array_merge($configPro, $configDes);
