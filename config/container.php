<?php

declare(strict_types=1);

use DI\ContainerBuilder;

$container = new ContainerBuilder();
$container->addDefinitions(__DIR__ . '/../config/container_bindings.php');
return $container->build();
