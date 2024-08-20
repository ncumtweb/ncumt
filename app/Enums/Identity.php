<?php

namespace App\Enums;

/**
 * conference 裡面的身份
 */
enum Identity: string {

    /**
     * 學生
     */
    case STUDENT = 'student';

    /**
     * 社會人士
     */
    case SOCIAL = 'social';

    /**
     * 將身份轉換成中文
     *
     * @return string
     */
    public function toChinese(): string
    {
        return match ($this) {
            self::STUDENT => '學生',
            self::SOCIAL => '社會人士',
        };
    }
}
