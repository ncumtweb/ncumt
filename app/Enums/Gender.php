<?php

namespace App\Enums;

enum Gender: int
{
    /**
     * 男
     */
    case MALE = 0;

    /**
     * 女
     */
    case FEMALE = 1;

    /**
     * 将性别转换为对应的中文描述
     *
     * @return string
     */
    public function toChinese(): string
    {
        return match ($this) {
            self::MALE => '男',
            self::FEMALE => '女',
        };
    }
}
