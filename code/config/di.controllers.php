<?php

use ComAI\ArduComponents\Ambient\Application\UseCase\RegisterAmbientUseCase;
use ComAI\ArduComponents\Ambient\Infrastructure\Controller\RegisterAmbientController;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;

$application = AppFactory::create();

$container = $application->getContainer();

return [
    RegisterAmbientController::class => function(ContainerInterface $container) {
        return new RegisterAmbientController(
            $container->get(RegisterAmbientUseCase::class)
        );
    }
];