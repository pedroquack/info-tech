<?php

namespace App\Policies;

use App\Enums\Roles;
use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function show(User $user, Project $project){
        return $user->id == $project->client->id || $user->role == Roles::ADM->value;
    }
}
