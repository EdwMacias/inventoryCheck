<?php

namespace App\Repositories\Interfaces;

use App\DTOs\RolesDTOs\RoleUserDTO;

interface InterfaceRolesUserRepository
{
    /**
     * Crea el rol del usuario
     * @param RoleUserDTO $roleUserDTO
     * @return bool
     */
    public function save(RoleUserDTO $roleUserDTO): bool;
    /**
     * Verifica si el rol existe
     * @param string $role_id
     * @return bool
     */
    public function roleExist(string $role_id): bool;

    /**
     * Elimina rol del usuario
     * @param string $user_role_id
     * id del rol del usuario
     */
    public function delete(string $user_role_id): bool;

    /**
     * verifica si el rol esta asignado
     * @param string $user_role_id
     * @return bool
     */
    public function existUserRoleId(string $user_role_id): bool;
}