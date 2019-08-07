<?php

use ComAI\ArduComponents\Ambient\Application\UseCase\RegisterAmbientUseCase;
use ComAI\ArduComponents\Ambient\Infrastructure\Factory\AmbientFactory;
use ComAI\ArduComponents\Ambient\Infrastructure\Repository\PDO\ComponentWriterPDO;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;

$application = AppFactory::create();

$container = $application->getContainer();

return [
    RegisterAmbientUseCase::class => function (ContainerInterface $container) {
        return new RegisterAmbientUseCase(
            $container->get(ComponentWriterPDO::class),
            $container->get(AmbientFactory::class)
        );
    }
];
