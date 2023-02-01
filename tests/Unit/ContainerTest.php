<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Exceptions\RouteNotFoundException;
use App\Container;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{
    public function test_it_resolves_a_class_from_the_container() : void
    {
        $container = new Container();
        $container->set('App\Services\PaddlePaymentService', 'App\Services\PaddlePaymentService');
        $this->assertInstanceOf('App\Services\PaddlePaymentService', $container->get('App\Services\PaddlePaymentService'));
    }


    

  


}