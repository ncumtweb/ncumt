<?php
namespace App\Enums;

enum RouteCategory: int
{
    case A = 0;
    case B = 1;
    case C = 2;

    public function label(): string
    {
        return match ($this) {
            self::A => '溯溪',
            self::B => '高山',
            self::C => '中級山',
        };
    }

}
