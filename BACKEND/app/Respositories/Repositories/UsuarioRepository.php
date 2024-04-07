<?php

namespace App\Respositories\Repositories;

use App\Models\User;
use App\Respositories\Interfaces\InterfaceUsuarioRepository;
use Illuminate\Database\Eloquent\Collection;


class UsuarioRepository extends User implements InterfaceUsuarioRepository
{
    public function createUser(array $usuario)
    {
        $usuario = new User($usuario);
        $usuario->save();
        return $usuario->getUserWithRelatedData();
    }
    public function updateUser(int $id, array $usuario): bool
    {
        $user = User::find($id);
        return $user->update($usuario);
    }

    public function deleteUser(User $usuario): bool
    {
        return $usuario->delete();
    }

    public function getUsersByRoleId(int $roleId): Collection
    {
        return User::where("role_id", $roleId)->get();
    }
    public function getUsersByDocumentTypeId(int $documentTypeId): Collection
    {
        return User::where("document_type_id", $documentTypeId)->get();
    }

    public function getUserByEmail(string $email)
    {
        return User::where("email", $email)->first();
    }

    public function getUserByID(int $id): ?User {
        return User::find($id)->first();
    }

}