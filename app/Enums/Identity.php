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
}
