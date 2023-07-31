<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RentalEquipment;
use App\Models\User;

class Rental extends Model
{
    use HasFactory;

    public function rentalEquipment() {
        return $this->hasmany(RentalEquipment::class)->orderBy('equipment_id', 'asc');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
