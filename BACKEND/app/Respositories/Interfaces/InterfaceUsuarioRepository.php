<?php

namespace App\Respositories\Interfaces;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Collection;


interface InterfaceUsuarioRepository
{
    // public function getUserById(int $id) : Collection;
    /** 
     * @param array $usuario 
     * @return User
     */
    public function createUser(array $usuario);
    /** 
     * @param int $userId 
     * @return bool
     */
    public function deleteUser(int $userId): bool;
    /** 
     * @param int $id 
     * @param array $usuario 
     * @return bool
     */
    public function updateUser(int $id, array $usuario): bool;
    /** 
     * @param string $email 
     * @return object|User|null
     */
    public function getUserByEmail(string $email);

    /** 
     * @param int $numberDocument 
     * @return object|User|null
     */
    public function getUserByNumberDocument(int $numberDocument);

    /** 
     * @param int $userId 
     * @return object|User|null
     */
    public function getUserByID(int $userId);

    /** 
     * @param int $userId 
     * @return bool
     */
    public function userExist(int $userId);
    /** 
     * @param string $email 
     * @return bool
     */
    public function EmailExist(string $email);
}
