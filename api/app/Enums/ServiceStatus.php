<?php

namespace App\Enums;

enum ServiceStatus : int
{
    case AVAILABLE = 1;
    case NOT_AVAILABLE = 0;

    public static function values(): array
    {
        return array_map(fn(self $status) => (string) $status->value, self::cases());
    }
}
