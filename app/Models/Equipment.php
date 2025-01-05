<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Equipment extends Model
{
    use HasFactory;
    protected $table = 'equipments';

    /**
     * 判斷是否為社員，返回對應的裝備價錢
     */
    public function getPrice() {
        return Auth::user()->role >= Role::MEMBER->value ? $this->member_price : $this->normal_price;
    }
}
