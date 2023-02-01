<?php

declare(strict_types = 1);

namespace App\Enums;

enum PaymentStatus : int
{
     case Pending = 0;
     case Paid = 1;
     case Failed = 2;
     case Cancelled = 3;

     public function text() : string
     {
           return match ($this) {
                self::Pending => 'Pending',
                self::Paid => 'Paid',
                self::Failed => 'Failed',
                self::Cancelled => 'Cancelled',
           };
     }
}