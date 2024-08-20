<?php

namespace App\Enums;

/**
 * 表單的模式
 */
enum Mode: string
{
    /**
     * 建立
     */
    case CREATE = 'create';

    case EDIT = 'edit';
}
