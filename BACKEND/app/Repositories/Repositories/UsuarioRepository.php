<?php

namespace App\Repositories\Repositories;

use App\DTOs\Usuario\UsuarioCreateDTO;
use App\DTOs\Usuario\UsuarioUpdateDTO;
use App\Models\User;
use App\Repositories\Interfaces\InterfaceUsuarioRepository;

class UsuarioRepository implements InterfaceUsuarioRepository
{

    /** 
     * @param UsuarioCreateDTO $usuarioCreateDTO 
     * @return bool
     */
    public function createUser(UsuarioCreateDTO $usuarioCreateDTO)
    {
        $usuario = new User($usuarioCreateDTO->toArray());
        return $usuario->save();
    }

    /** 
     * @param string $userId 
     * @param UsuarioUpdateDTO $usuario 
     * @return bool
     */
    public function updateUser(string $userId, UsuarioUpdateDTO $usuarioUpdateDTO): bool
    {
        return User::find($userId)->update($usuarioUpdateDTO->toArray());
    }

    /** 
     * @param int $userId 
     * @return bool
     */
    public function deleteUser(int $userId): bool
    {
        return User::find($userId)->delete();
    }

    /** 
     * @param int $numberDocument 
     * @return object|User|null
     */

    public function getUserByNumberDocument(int $numberDocument)
    {
        return User::where("number_document", $numberDocument)->first();
    }

    /** 
     * @param string $email 
     * @return object|User|null
     */
    public function getUserByEmail(string $email)
    {
        return User::where("email", strtolower($email))->first();
    }

    /** 
     * @param string $email 
     * @return bool
     */
    public function EmailExist(string $email)
    {
        return User::where("email", $email)->exists();
    }

    /** 
     * @param string $userId 
     * @return object|User|null
     */
    public function getUserByID(string $userId)
    {
        return User::find($userId);
    }

    /**
     *
     * @param int $userId
     * @return bool
     */
    public function userExist(int $userId)
    {
        return User::where("user_id", $userId)->exists();
    }
}