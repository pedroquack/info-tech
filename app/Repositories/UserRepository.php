<?php

namespace App\Repositories;

use App\Enums\Roles;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    public function getAll()
    {
        return User::all();
    }

    public function getAllClients()
    {
        return User::where('role', Roles::CLI->value)->get();
    }

    public function getAllAdmins()
    {
        return User::where('role', Roles::ADM->value)->get();
    }

    public function findById(int $id)
    {
        return User::find($id);
    }

    public function create(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        $data['role'] = Roles::from($data['role']);
        return User::create($data);
    }

    public function update(int $id, array $data)
    {
        $data['role'] = Roles::from($data['role']);
        $user = $this->findById($id);
        if ($user) {
            $user->update($data);
        }

        return $user;
    }

    public function delete(int $id)
    {
        $user = $this->findById($id);
        if ($user) {
            $user->delete();
        }

        return $user;
    }
}
