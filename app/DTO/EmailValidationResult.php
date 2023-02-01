<?php

namespace App\DTO;

class EmailValidationResult
{
    public function __construct(public readonly int|string $score, public readonly bool $isDeliverable)
    {

    }
}