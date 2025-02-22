<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BaseModel extends Model
{
    protected static function boot(): void
    {
        parent::boot();

        // 在創建時自動寫入 create_user 和 modify_user
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->create_user = Auth::id();
                $model->modify_user = Auth::id();
            }
        });

        // 在更新時只更新 modify_user
        static::updating(function ($model) {
            if (Auth::check()) {
                $model->modify_user = Auth::id();
            }
        });
    }
}
