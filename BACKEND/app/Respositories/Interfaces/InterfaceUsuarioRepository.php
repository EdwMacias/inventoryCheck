<?php

namespace App\Respositories\Interfaces;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Collection;


interface InterfaceUsuarioRepository{
    // public function getUserById(int $id) : Collection;
    public function createUser(array $usuario);
    public function deleteUser(User $usuario) : bool;
    public function updateUser(int $id, array $usuario) : bool;
    public function getUsersByRoleId(int $roleId) : Collection;
    public function getUserByEmail(string $email);
    public function getUsersByDocumentTypeId(int $documentTypeId) : Collection;

    public function getUserByID(int $id): ?User;
}
