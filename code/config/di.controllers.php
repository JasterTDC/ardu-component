<?php

use ComAI\ArduComponents\Ambient\Application\UseCase\RegisterAmbientUseCase;
use ComAI\ArduComponents\Ambient\Infrastructure\Controller\RegisterAmbientController;
use ComAI\ArduComponents\WorkingCheck\Application\UseCase\SesamePanelUseCase;
use ComAI\ArduComponents\WorkingCheck\Infrastructure\Controller\SesameImproveController;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;

$application = AppFactory::create();

$container = $application->getContainer();

return [
    RegisterAmbientController::class => function (ContainerInterface $container) {
        return new RegisterAmbientController(
            $container->get(RegisterAmbientUseCase::class)
        );
    },
    SesameImproveController::class => function (ContainerInterface $container) {
        return new SesameImproveController(
            $container->get(SesamePanelUseCase::class)
        );
    }
];
