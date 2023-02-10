<?php

declare (strict_types = 1);

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
$app = require __DIR__ . '/../bootstrap.php';
$container = $app->getContainer();
$router = require CONFIG_PATH . '/routes.php';
// Register routes
$router($app);
// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $container->get(Twig::class)));
// Add Error Handling Middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
// Run App & Emit Response
$app->run();
