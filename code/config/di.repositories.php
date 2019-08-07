<?php

use ComAI\ArduComponents\Ambient\Infrastructure\Factory\AmbientFactory;
use ComAI\ArduComponents\Ambient\Infrastructure\Repository\PDO\ComponentWriterPDO;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;

$application = AppFactory::create();

$container = $application->getContainer();

return [
    'ComponentReaderDatabase' => function (ContainerInterface $container) {
        $databaseConfig = $container->get('config')['database']['ComponentReaderDatabase'];

        $dsn = "{$databaseConfig['engine']}:host={$databaseConfig['hostname']};".
            "charset={$databaseConfig['charset']};".
            "port={$databaseConfig['port']};".
            "dbname={$databaseConfig['database']}";

        return new PDO(
            $dsn,
            $databaseConfig['username'],
            $databaseConfig['password']
        );
    },
    'ComponentWriterDatabase' => function (ContainerInterface $container) {
        $databaseConfig = $container->get('config')['database']['ComponentWriterDatabase'];

        $dsn = "{$databaseConfig['engine']}:host={$databaseConfig['hostname']};".
            "charset={$databaseConfig['charset']};".
            "port={$databaseConfig['port']};".
            "dbname={$databaseConfig['database']}";

        $pdo = new PDO(
            $dsn,
            $databaseConfig['username'],
            $databaseConfig['password']
        );

        $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $pdo;
    },
    ComponentWriterPDO::class => function (ContainerInterface $container) {
        $dateFormat = $container->get('config')['dateFormat'];

        return new ComponentWriterPDO(
            $container->get('ComponentWriterDatabase'),
            $container->get(AmbientFactory::class),
            $dateFormat
        );
    }
];
