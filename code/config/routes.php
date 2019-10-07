<?php

use ComAI\ArduComponents\Ambient\Infrastructure\Controller\RegisterAmbientController;
use ComAI\ArduComponents\Sesame\Infrastructure\Controller\SesameController;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

$application = AppFactory::create();

$application->group('/ambient', function (RouteCollectorProxy $routeCollector) {
    $routeCollector
        ->post('/register', RegisterAmbientController::class)
        ->setName('register-ambient');
});

$application->group('/sesame', function(RouteCollectorProxy $routeCollector) {
    $routeCollector
        ->get('/check', SesameController::class)
        ->setName('register-sesame');
});
