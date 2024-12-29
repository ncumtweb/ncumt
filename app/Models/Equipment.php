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

    public function getPrice() {
        return Auth::user()->role >= Role::MEMBER->value ? $this->member_price : $this->normal_price;
    }
}
