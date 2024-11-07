<?php

namespace App\Enums;

enum JudgementRank: int
{
    case SSS = 13;
    case S_PLUS = 12;
    case S = 11;
    case S_MINUS = 10;
    case A_PLUS = 9;
    case A = 8;
    case A_MINUS = 7;
    case B_PLUS = 6;
    case B = 5;
    case B_MINUS = 4;
    case C_PLUS = 3;
    case C = 2;
    case C_MINUS = 1;
    case D = 0;

    public function label(): string
    {
        return match ($this) {
            self::SSS => 'SSS',
            self::S_PLUS => 'S+',
            self::S => 'S',
            self::S_MINUS => 'S-',
            self::A_PLUS => 'A+',
            self::A => 'A',
            self::A_MINUS => 'A-',
            self::B_PLUS => 'B+',
            self::B => 'B',
            self::B_MINUS => 'B-',
            self::C_PLUS => 'C+',
            self::C => 'C',
            self::C_MINUS => 'C-',
            self::D => 'D',
        };
    }

}
