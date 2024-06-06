<?php

namespace App\Repositories\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\InterfaceUsuarioRepository;

class UsuarioRepository implements InterfaceUsuarioRepository
{

    /** 
     * @param array $usuario 
     * @return bool
     */
    public function createUser(array $usuario)
    {
        $usuario = new User($usuario);
        // return $usuario;
        return $usuario->save();
    }

    /** 
     * @param int $id 
     * @param array $usuario 
     * @return bool
     */
    public function updateUser(int $user_id, array $usuario): bool
    {
        return User::find($user_id)->update($usuario);
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
        return User::where("email", $email)->first();
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
     * @param int $userId 
     * @return object|User|null
     */
    public function getUserByID(int $userId)
    {
        return User::find($userId)->first();
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