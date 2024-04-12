<?php

namespace App\Respositories\Repositories;

use App\Models\Users\User;
use App\Respositories\Interfaces\InterfaceUsuarioRepository;
use Illuminate\Database\Eloquent\Collection;


class UsuarioRepository extends User implements InterfaceUsuarioRepository
{
    
    /** 
    * @param array $usuario 
    * @return User
    */
    public function createUser(array $usuario)
    {
        return parent::create($usuario);
    }

    /** 
    * @param int $id 
    * @param array $usuario 
    * @return bool
    */
    public function updateUser(int $id, array $usuario): bool
    {
        return parent::find($id)->update($usuario);
    }

    /** 
    * @param int $userId 
    * @return bool
    */
    public function deleteUser(int $userId): bool
    {
        return parent::find($userId)->delete();
    }

     /** 
    * @param int $numberDocument 
    * @return object|User|null
    */

    public function getUserByNumberDocument(int $numberDocument)
    {
        return parent::where("number_document", $numberDocument)->first();
    }

    /** 
    * @param string $email 
    * @return object|User|null
    */
    public function getUserByEmail(string $email)
    {
        return parent::where("email", $email)->first();
    }

    /** 
    * @param string $email 
    * @return bool
    */
    public function EmailExist(string $email)
    {
        return parent::where("email", $email)->exists();
    }

    /** 
    * @param int $userId 
    * @return object|User|null
    */
    public function getUserByID(int $userId)
    {
        return parent::find($userId)->first();
    }

    /**
     *
     * @param int $userId
     * @return bool
     */
    public function userExist(int $userId) {
        return parent::where("user_id", $userId)->exists();
    }
}