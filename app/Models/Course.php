<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $dates = ['start_date', 'end_date'];

    public function courseRecord(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CourseRecord::class);
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_records', 'course_id', 'user_id');
    }
}

