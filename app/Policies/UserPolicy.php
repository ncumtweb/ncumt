<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * 本人或幹部（與 checkRole middleware 相同門檻）才能編輯個人資料
     */
    public function update(User $actor, User $user): bool
    {
        return $actor->id === $user->id || $actor->role > Role::MEMBER->value;
    }
}
