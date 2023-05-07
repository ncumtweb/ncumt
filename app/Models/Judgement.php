<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judgement extends Model
{
    use HasFactory;

    protected $table = 'judgements';
    protected $guarded = ['result_level'];
}
