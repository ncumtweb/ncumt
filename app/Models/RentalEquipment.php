<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class RentalEquipment extends BaseModel
{
    use HasFactory;

    public function equipment() {
        return $this->belongsTo(Equipment::class);
    }

    public function rental() {
        return $this->belongsTo(Rental::class);
    }
}
