<?php

namespace App\Repositories\Interfaces;

use App\DTOs\RolesDTOs\RoleUserDTO;
use App\Models\Users\Role;
use App\Models\Users\UserRole;

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

    /**
     * Obtener Rol de usuario
     * @param string $user_id
     * @return \App\Models\Users\UserRole | null
     */
    public function getRoleUser(string $user_id): UserRole|null;

    
    /**
     * Obtener Rol de usuario
     * @param string $user_id
     * @return \App\Models\Users\Role | null
     */
    public function getRole(string $role_id) :Role;
    /**
     * @param string $role_id
     * id del rol a buscar 
     * @param string $user_id
     * id del usuario a buscar
     * @return bool
     */
    public function roleInUser(string $role_id, string $user_id): bool;
    /**
     * @param string $role_user_id
     * role_user_id para buscar
     * @param string $user_id
     */
    public function roleUserIdInUser(string $role_user_id, string $user_id): bool;


}