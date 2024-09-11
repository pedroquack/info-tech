<?php

namespace App\Interfaces;

interface UserRepositoryInterface{
    public function getAllClients();
    public function getAllAdmins();
    public function getAll();
    public function findById(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
