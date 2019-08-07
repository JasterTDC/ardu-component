<?php

use ComAI\ArduComponents\Ambient\Infrastructure\Factory\AmbientFactory;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;

$application = AppFactory::create();

$container = $application->getContainer();

return [
    AmbientFactory::class => function (ContainerInterface $container) {
        $dateFormat = $container->get('config')['dateFormat'];

        return new AmbientFactory($dateFormat);
    }
];
