<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipment;
use App\Models\Rental;

class RentalEquipment extends Model
{
    use HasFactory;

    public function equipment() {
        return $this->belongsTo(Equipment::class);
    }

    public function rental() {
        return $this->belongsTo(Rental::class);
    }
}
