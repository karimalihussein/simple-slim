<?php

declare(strict_types = 1);

namespace App;

use App\Contracts\EmailValidationInterface;
use App\Exceptions\RouteNotFoundException;
use App\Interfaces\PaymentGatewayServiceInterface;
use App\Services\Emailable\EmailValidationService;
use App\Services\InvoiceService;
use App\Services\PaddlePaymentService;
use App\Services\PaymentGatewayService;
use Dotenv\Dotenv;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Database\Capsule\Manager as Capsule;
use Symfony\Component\Mailer\MailerInterface;

class App
{
    private Config $config;

    public function __construct(protected Container $container,protected ?Router $router = null, protected array $request = [])
    {
    
    }
    public function initDb(array $config)
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
        $capsule = new Capsule();
        $capsule->addConnection($config);
        $capsule->setEventDispatcher(new Dispatcher());
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    public function boot() : static
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();
        $this->config = new Config($_ENV);
        $this->initDb($this->config->db);
        $this->container->bind(MailerInterface::class, fn() => new CustomMailer($this->config->mailer['dns']));
        $this->container->bind(EmailValidationInterface::class, fn() => new EmailValidationService($this->config->apiKeys['emailable']));

        return $this;
    }

    public function run()
    {
        try {
            echo $this->router->resolve($this->request['uri'], strtolower($this->request['method']));
        } catch (RouteNotFoundException) {
            http_response_code(404);
            echo View::make('error/404');
        }
    }
}
