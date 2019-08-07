<?php

return [
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
    ],
    'dependenciesDef' => [
        'repositories'  => __DIR__ . '/di.repositories.php',
        'services'      => __DIR__ . '/di.services.php',
        'factories'     => __DIR__ . '/di.factories.php',
        'useCases'      => __DIR__ . '/di.use_cases.php',
        'controllers'   => __DIR__ . '/di.controllers.php'
    ],
    'dateFormat' => 'Y-m-d H:i:s'
];
