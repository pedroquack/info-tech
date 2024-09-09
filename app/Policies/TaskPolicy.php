<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function isResponsible(User $user, Task $task){
        return $user->id === $task->responsible->id;
    }
}
