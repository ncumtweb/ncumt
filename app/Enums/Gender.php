<?php

namespace App\Enums;

enum Gender: int
{
    /**
     * 男
     */
    case MALE = 1;

    /**
     * 女
     */
    case FEMALE = 2;

    public function toChinese(): string
    {
        return match ($this) {
            self::MALE => '男',
            self::FEMALE => '女',
        };
    }
}
