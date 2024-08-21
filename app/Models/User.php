<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Post;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // public function getRoleAttribute()
    // {
    //     // 定義索引值到文字形式角色的映射
    //     $roles = [
    //         1 => '社員',
    //         2 => '幹部',

    //     ];
    //     社員 => 0, 社長 => 1, 副社長 => 2, 嚮導組組長 => 3, 嚮導組組員 => 4,
    //     技術組組長 => 5, 技術組組員 => 6, 器材組組長 => 7, 器材組組員 => 8, 醫藥組組長 => 9,
    //     醫藥組組員 => 10, 文書組組長 => 11, 文書組組員 => 12, 美宣 => 13, 網管 => 14,
    //     財務長 => 15, 山防組組長 => 16
    //     return $roles[$this->attributes['role']] ?? '未知角色';
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public function post() {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*更新 modify_user 和 updated_at 字段,抽成共用*/
    public function setModifiedUser()
    {
        $this->modify_user = auth()->user()->id;
        $this->updated_at = now();
    }
}
