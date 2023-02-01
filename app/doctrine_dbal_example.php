<?php

use Doctrine\DBAL\DriverManager;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$connectionParams = [
    'dbname'     => $_ENV[ 'DB_DATABASE'],
    'user'       => $_ENV[ 'DB_USERNAME'],
    'password'   => $_ENV[ 'DB_PASSWORD'],
    'host'       => $_ENV[ 'DB_HOST'],
    'driver'     => $_ENV[ 'DB_CONNECTION'] ?? 'pdo_mysql',
];
$conn = DriverManager::getConnection($connectionParams);
$stmt = $conn->prepare('SELECT * FROM emails');
$result = $stmt->executeQuery();
var_dump($result->fetchAllAssociative());