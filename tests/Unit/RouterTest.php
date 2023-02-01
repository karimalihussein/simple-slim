<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Container;
use App\Exceptions\RouteNotFoundException;
use App\Router;
use PHPUnit\Framework\TestCase;


class RouterTest extends TestCase
{
    /**
     * @var Router
     */
    private Router $router;
    protected function setUp() : void
    {
        parent::setUp();
        $container = new Container();
        $this->router = new Router($container);
    }
    public function test_it_register_a_route() : void
    {
        $this->router->register('GET', 'users', ['Users', 'index']);
        $expected = [
            'GET' => [
                'users' => ['Users', 'index']
            ]
        ];
        $this->assertEquals($expected, $this->router->routes());
    }

    public function test_it_register_a_get_route() : void
    {
        $this->router->get('/users', ['Users', 'index']);
        $expected = [
            'get' => [
                '/users' => ['Users', 'index']
            ]
        ];
        $this->assertEquals($expected, $this->router->routes());
    }

    public function test_it_register_a_post_route() : void
    {
        $this->router->post('/users', ['Users', 'store']);
        $expected = [
            'post' => [
                '/users' => ['Users', 'store']
            ]
        ];
        $this->assertEquals($expected, $this->router->routes());
    }

    public function test_there_are_no_routes_when_router_is_empty() : void
    {
        $this->assertEmpty((new Router(new Container()))->routes());
    }


   /**
     * @test
     * @dataProvider routeNotFoundCases
     */
    public function it_throws_route_not_found_exception(
        string $requestUri,
        string $requestMethod
    ): void {
        $users = new class() {
            public function delete(): bool
            {
                return true;
            }
        };

        $this->router->post('/users', [$users::class, 'store']);
        $this->router->get('/users', ['Users', 'index']);

        $this->expectException(RouteNotFoundException::class);
        $this->router->resolve($requestUri, $requestMethod);
    }

    public function routeNotFoundCases(): array
    {
        return [
            ['/users', 'put'],
            ['/invoices', 'post'],
            ['/users', 'get'],
            ['/users', 'post'],
        ];
    }

    
}