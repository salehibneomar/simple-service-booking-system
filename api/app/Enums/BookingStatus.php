<?php

namespace App\Enums;

enum BookingStatus: int
{
    case PENDING = 2;
    case CONFIRMED = 1;
    case CANCELLED = 0;

    public static function values(): array
    {
        return array_map(fn(self $status) => (string) $status->value, self::cases());
    }
}
