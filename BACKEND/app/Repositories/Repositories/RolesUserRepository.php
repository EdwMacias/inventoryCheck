<?php

namespace App\Repositories\Repositories;

use App\DTOs\RolesDTOs\RoleUserDTO;
use App\Models\Users\Role;
use App\Models\Users\UserRole;
use App\Repositories\Interfaces\InterfaceRolesUserRepository;

class RolesUserRepository implements InterfaceRolesUserRepository
{

    /**
     * @param string $role_id
     * @return bool
     */
    public function roleExist(string $role_id): bool
    {
        return Role::where('role_id', $role_id)->exists();
    }


    /**
     * Crea el rol del usuario
     * @param RoleUserDTO $roleUserDTO
     * @return bool
     */
    public function save(RoleUserDTO $roleUserDTO): bool
    {
        UserRole::create($roleUserDTO->toArray());
        return true;
    }

    /**
     * Elimina rol del usuario
     * @param string $user_role_id
     * id del rol del usuario
     */
    public function delete(string $user_role_id): bool
    {
        return UserRole::where('user_role_id', $user_role_id)->delete();
    }
    /**
     * verifica si el rol esta asignado
     * @param string $user_role_id
     * @return bool
     */
    public function existUserRoleId(string $user_role_id): bool
    {
        return UserRole::where('user_role_id', $user_role_id)->exists();
    }

    /**
     * Obtener Rol de usuario
     * @param string $user_id
     * @return UserRole | null
     */
    public function getRoleUser(string $user_id): UserRole|null
    {
        return UserRole::where('user_id', $user_id)->first();
    }
    /**
     * Obtener Rol de usuario
     * @param string $user_id
     * @return Role | null
     */
    public function getRole(string $role_id): Role
    {
        return Role::where('role_id', $role_id)->first('name');
    }

    /**
     * @param string $role_id
     * @param string $user_id
     */
    public function roleInUser(string $role_id, string $user_id): bool
    {
        return UserRole::where('role_id', $role_id)->where('user_id',$user_id)->exists();
    }
    /**
     * @param string $role_user_id
     * @param string $user_id
     */
    public function roleUserIdInUser(string $role_user_id, string $user_id): bool
    {
        return UserRole::where('user_role_id', $role_user_id)->where('user_id',$user_id)->exists();
    }

}
