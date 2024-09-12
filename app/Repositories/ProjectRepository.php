<?php

namespace App\Repositories;

use App\Interfaces\ProjectRepositoryInterface;
use App\Models\Project;

class ProjectRepository implements ProjectRepositoryInterface
{

    public function getAll()
    {
        return Project::all();
    }

    public function getByClient(int $client_id){
        return Project::where('client_id', $client_id)->get();
    }

    public function findById(int $id)
    {
        return Project::find($id);
    }

    public function create(array $data)
    {
        return Project::create($data);
    }

    public function update(int $id, array $data)
    {
        $project = $this->findById($id);
        if ($project) {
            $project->update($data);
        }
        return $project;
    }

    public function delete(int $id)
    {
        $project = $this->findById($id);
        if ($project) {
            $project->delete();
        }

        return $project;
    }
}
