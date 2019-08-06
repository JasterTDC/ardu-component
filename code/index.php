<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/constants.php';

use DI\ContainerBuilder;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$config = require_once __DIR__ . '/config/' . APPLICATION_ENV . '.php';

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    'config'    => $config
]);
$containerBuilder->addDefinitions(__DIR__ . '/config/di.services.php');

$container = $containerBuilder->build();

AppFactory::setContainer($container);

$application = AppFactory::create();

$application->addRoutingMiddleware();

$application->addErrorMiddleware(true, true, true);

$application->get('/', function(Request $request, Response $response) {
    $response = $response->withHeader('Content-type', 'application/json');

    $response->getBody()->write(
        json_encode([
            'success' => true
        ])
    );

    return $response;
});

$application->run();
