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
        return UserRole::save($roleUserDTO->toArray());
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
}
