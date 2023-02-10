<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\InvoiceController;
use Slim\App;

// create closure for routes with parameters
// function(\Slim\App $app, string $path, string $controller, string $method) {
//     $app->get($path, $controller . ':' . $method);
// };

return function (App $app) {
    $app->get('/', HomeController::class . ':index');
    $app->get('/invoices', InvoiceController::class . ':index');
};
