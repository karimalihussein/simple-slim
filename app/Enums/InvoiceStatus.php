<?php

declare(strict_types=1);

namespace App\Enums;

enum InvoiceStatus: int
{
    case Pending = 0;
    case Paid = 1;
    case Void = 2;
    case Failed = 3;
    

    public function toString()
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Paid => 'Paid',
            self::Void => 'Void',
            self::Failed => 'Declined',
            default => throw new \Exception('Invalid Invoice Status'),
        };
    }

    public function toHtml()
    {
        return match ($this) {
            self::Pending => '<span class="badge badge-warning">Pending</span>',
            self::Paid => '<span class="badge badge-success">Paid</span>',
            self::Void => '<span class="badge badge-danger">Void</span>',
            self::Failed => '<span class="badge badge-danger">Declined</span>',
            default => throw new \Exception('Invalid Invoice Status'),
        };
    }

    public function toCssClass()
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Paid => 'success',
            self::Void => 'danger',
            self::Failed => 'danger',
            default => throw new \Exception('Invalid Invoice Status'),
        };
    }

    public function toIcon()
    {
        return match ($this) {
            self::Pending => 'fa-clock',
            self::Paid => 'fa-check',
            self::Void => 'fa-times',
            self::Failed => 'fa-times',
            default => throw new \Exception('Invalid Invoice Status'),
        };
    }

    public function toIconColor()
    {
        return match ($this) {
            self::Pending => 'text-warning',
            self::Paid => 'text-success',
            self::Void => 'text-danger',
            self::Failed => 'text-danger',
            default => throw new \Exception('Invalid Invoice Status'),
        };
    }
}