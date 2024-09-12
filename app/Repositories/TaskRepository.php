<?php

namespace App\Repositories;

use App\Enums\Status;
use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface{
    public function findById(int $id)
    {
        return Task::find($id);
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function isUserResponsible(int $task_id, int $user_id){
        $task = $this->findById($task_id);
        return $task->responsible->id === $user_id;
    }

    public function update(int $id, array $data)
    {
        $data['status'] = Status::from($data['status']);
        $task = $this->findById($id);
        if($task){
            $task->update($data);
        }
        return $task;
    }

    public function delete(int $id)
    {
        $task = $this->findById($id);
        if($task){
            $task->delete();
        }

        return $task;
    }

}
