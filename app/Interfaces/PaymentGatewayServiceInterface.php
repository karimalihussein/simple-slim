<?php

declare(strict_types = 1);

namespace App\Interfaces;

interface PaymentGatewayServiceInterface
{
    public function charge(array $customer, float $amount, float $tax): bool;
}