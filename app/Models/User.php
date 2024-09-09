<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public function isValidIdentifiers(array $studentIds): bool
    {
        return in_array($this->student_id, $studentIds);
    }

    /*更新 modify_user 和 updated_at 字段,抽成共用*/
    public function setModifiedUser()
    {
        $this->modify_user = auth()->user()->id;
        $this->updated_at = now();
    }
}
