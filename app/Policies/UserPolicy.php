<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * 本人或網管才能編輯個人資料（與使用者列表只對網管顯示編輯按鈕一致）
     */
    public function update(User $actor, User $user): bool
    {
        return $actor->id === $user->id || (int) $actor->role === Role::WEB_ADMIN->value;
    }
}
