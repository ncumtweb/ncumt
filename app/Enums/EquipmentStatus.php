<?php

namespace App\Enums;

/**
 * 設備狀態
 */
enum EquipmentStatus: int {

    /**
     * 未借出
     */
    case NOT_BORROWED = 0;

    /**
     * 借出
     */
    case BORROWED = 1;

    /**
     * 遺失
     */
    case LOST = 2;

    public function toChinese(): string
    {
        return match ($this) {
            self::NOT_BORROWED => '未借出',
            self::BORROWED => '借出',
            self::LOST => '遺失',
        };
    }
}
