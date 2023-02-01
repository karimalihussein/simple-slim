<?php

declare(strict_types=1);

use App\Config;
use App\Controllers\HomeController;
use App\Controllers\InvoiceController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Twig\Extra\Intl\IntlExtension;
use DI\Container;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'data' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);
define('STORAGE_PATH', $root . 'storage' . DIRECTORY_SEPARATOR);

// Load environment variables
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
// Instantiate PHP-DI Container
$container = new Container();
// Set container to create Config with .env variables
$container->set(Config::class, fn() => new Config($_ENV));
// Set container to Entity Manager, with injected Config, and Entity path
$container->set(EntityManager::class, fn(Config $config) => EntityManager::create(
    $config->db,
    ORMSetup::createAttributeMetadataConfiguration([__DIR__ . '/../app/Entity'])
));
// Set container to create App with on AppFactory
AppFactory::setContainer($container);
// Create App
$app = AppFactory::create();
// routes
$app->get('/', HomeController::class . ':index');
$app->get('/invoices', InvoiceController::class . ':index');
// Add Twig-View Middleware
$twig = Twig::create(VIEWS_PATH, [
    'cache' => STORAGE_PATH . 'cache',
    'debug' => true,
]);
// Add extensions
$twig->addExtension(new IntlExtension());
// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));
// Add Error Handling Middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
// Run App & Emit Response
$app->run();


