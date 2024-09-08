<?php

namespace App\Enums;

enum Role: int
{
    /**
     * 非社員
     */
    case NON_MEMBER = -1;
    /**
     * 社員
     */
    case MEMBER = 0;

    /**
     * 社長
     */
    case CLUB_LEADER = 1;

    /**
     * 副社長
     */
    case VICE_CLUB_LEADER = 2;

    /**
     * 嚮導組組長
     */
    case GUIDE_LEADER = 3;

    /**
     * 嚮導組組員
     */
    case GUIDE_MEMBER = 4;

    /**
     * 技術組組長
     */
    case TECH_LEADER = 5;

    /**
     * 技術組組員
     */
    case TECH_MEMBER = 6;

    /**
     * 器材組組長
     */
    case EQUIPMENT_LEADER = 7;

    /**
     * 器材組組員
     */
    case EQUIPMENT_MEMBER = 8;

    /**
     * 醫藥組組長
     */
    case MEDICAL_LEADER = 9;

    /**
     * 醫藥組組員
     */
    case MEDICAL_MEMBER = 10;

    /**
     * 文書組組長
     */
    case SECRETARY_LEADER = 11;

    /**
     * 文書組組員
     */
    case SECRETARY_MEMBER = 12;

    /**
     * 美宣
     */
    case DESIGN = 13;

    /**
     * 網管
     */
    case WEB_ADMIN = 14;

    /**
     * 財務長
     */
    case TREASURER = 15;

    /**
     * 山防組組長
     */
    case SAFETY_LEADER = 16;

    /**
     * 山防組組員
     */
    case SAFETY_MEMBER = 17;

    public function toChinese(): string
    {
        return match($this) {
            self::NON_MEMBER => '非社員',
            self::MEMBER => '社員',
            self::CLUB_LEADER => '社長',
            self::VICE_CLUB_LEADER => '副社長',
            self::GUIDE_LEADER => '嚮導組組長',
            self::GUIDE_MEMBER => '嚮導組組員',
            self::TECH_LEADER => '技術組組長',
            self::TECH_MEMBER => '技術組組員',
            self::EQUIPMENT_LEADER => '器材組組長',
            self::EQUIPMENT_MEMBER => '器材組組員',
            self::MEDICAL_LEADER => '醫藥組組長',
            self::MEDICAL_MEMBER => '醫藥組組員',
            self::SECRETARY_LEADER => '文書組組長',
            self::SECRETARY_MEMBER => '文書組組員',
            self::DESIGN => '美宣',
            self::WEB_ADMIN => '網管',
            self::TREASURER => '財務長',
            self::SAFETY_LEADER => '山防組組長',
            self::SAFETY_MEMBER => '山防組組員',
        };
    }
}
