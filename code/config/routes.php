<?php

use ComAI\ArduComponents\Ambient\Infrastructure\Controller\RegisterAmbientController;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

$application = AppFactory::create();

$application->group('/ambient', function(RouteCollectorProxy $routeCollector) {
    $routeCollector
        ->post('/register', RegisterAmbientController::class)
        ->setName('register-ambient');
});
