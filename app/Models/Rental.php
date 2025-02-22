<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rental extends BaseModel
{
    use HasFactory;

    public function rentalEquipment(): HasMany
    {
        return $this->hasmany(RentalEquipment::class)->orderBy('equipment_id', 'asc');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
