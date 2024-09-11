<?php

namespace App\Policies;

use App\Enums\Roles;
use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    //Autorização para clientes e admins acessarem o projeto
    public function show(User $user, Project $project){
        //Retorna true se o id do usuário autenticado for o mesmo id do cliente do projeto especificado
        //ou
        //Retorna true se o cargo do usuário autenticado for ADMIN
        return $user->id == $project->client->id || $user->role == Roles::ADM->value;
    }
}
