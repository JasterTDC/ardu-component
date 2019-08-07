<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/constants.php';

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

$config = require_once __DIR__ . '/config/' . APPLICATION_ENV . '.php';

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    'config'    => $config
]);
foreach ($config['dependenciesDef'] as $name => $file) {
    $containerBuilder->addDefinitions($file);
}

$container = $containerBuilder->build();

AppFactory::setContainer($container);

$application = AppFactory::create();

$application->addRoutingMiddleware();

require_once __DIR__ . '/config/routes.php';

$application->addErrorMiddleware(true, true, true);

$application->run();
