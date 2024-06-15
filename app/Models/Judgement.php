<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judgement extends Model
{
    use HasFactory;

    /**
     * @var array 設定哪些欄位不能被批量寫入
     */
    protected $guarded = ['result_level'];
}
