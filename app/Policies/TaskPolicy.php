<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    //Autorização para responsável pela tarefa
    public function isResponsible(User $user, Task $task){
        //Retorna true se o ID do usuário autenticado for o mesmo ID do responsável pela tarefa
        return $user->id === $task->responsible->id;
    }
}
