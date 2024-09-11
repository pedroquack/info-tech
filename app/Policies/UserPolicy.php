<?php

namespace App\Policies;

use App\Enums\Roles;
use App\Models\User;

class UserPolicy
{
    //Autorização de admin
    public function isAdmin(User $user){
        //Retorna true se o cargo do usuário autenticado for ADMIN
        return $user->role == Roles::ADM->value;
    }
}
