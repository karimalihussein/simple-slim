<?php

declare (strict_types = 1);

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/path_constants.php';

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
// Instantiate PHP-DI Container
$container = require CONFIG_PATH . '/container.php';
// Set container to create App with on AppFactory
AppFactory::setContainer($container);
// Create App
return AppFactory::create();