<?php

namespace App\Policies;

use App\Enums\Roles;
use App\Models\User;

class UserPolicy
{
    public function isAdmin(User $user){
        return $user->role == Roles::ADM->value;
    }
}
