<?php

namespace App\Enums;

enum UserStatus: int
{
    case ACTIVE = 1;
    case BLOCKED = 0;

    public static function values(): array
    {
        return array_map(fn(self $status) => (string) $status->value, self::cases());
    }
}
