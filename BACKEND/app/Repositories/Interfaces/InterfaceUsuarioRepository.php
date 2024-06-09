<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Usuario\UsuarioCreateDTO;
use App\DTOs\Usuario\UsuarioUpdateDTO;
use App\Models\User;

interface InterfaceUsuarioRepository
{
    // public function getUserById(int $id) : Collection;
    /** 
     * @param array $usuario 
     * @return bool
     */
    public function createUser(UsuarioCreateDTO $usuarioCreateDTO);
    /** 
     * @param int $userId 
     * @return bool
     */
    public function deleteUser(int $userId): bool;
    /** 
     * @param string $userId 
     * @param UsuarioUpdateDTO $usuarioUpdateDTO 
     * @return bool
     */
    public function updateUser(string $userId, UsuarioUpdateDTO $usuarioUpdateDTO): bool;
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
     * @param string $userId 
     * @return object|User|null
     */
    public function getUserByID(string $userId);

    /** 
     * @param int $userId 
     * @return bool
     */
    public function userExist(int $userId);
    /** 
     * Comprueba si el email ya esta registrado
     * @param string $email 
     * @return bool
     */
    public function EmailExist(string $email);
}
