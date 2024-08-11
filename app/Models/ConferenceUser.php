<?php

namespace App\Models;

use App\Enums\Gender;
use App\Enums\Identity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ConferenceUser extends Model
{
    use HasFactory;

    /**
     * 取得性別前端呈現的字串
     *
     * @param string $gender
     * @return string
     */
    public function getGenderString(string $gender): string
    {
        return Gender::MALE->value == $this->gender  ? '男' : '女';
    }
}
