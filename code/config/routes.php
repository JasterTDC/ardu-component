<?php

use ComAI\ArduComponents\Ambient\Infrastructure\Controller\RegisterAmbientController;
use ComAI\ArduComponents\Main\Infrastructure\Controller\MainController;
use ComAI\ArduComponents\WorkingCheck\Infrastructure\Controller\SesameController;
use ComAI\ArduComponents\WorkingCheck\Infrastructure\Controller\SesameImproveController;
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

    $routeCollector
        ->get('/check-improve', SesameImproveController::class)
        ->setName('check-sesame');
});

$application->group('/', function(RouteCollectorProxy $routeCollector) {
    $routeCollector
        ->get('', MainController::class)
        ->setName('main');
});
