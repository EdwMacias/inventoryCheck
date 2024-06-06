<?php

namespace App\Repositories\Repositories;

use App\Models\Users\Role;
use App\Models\Users\UserRole;
use App\Repositories\Interfaces\InterfaceRolesUsuarioRepository;

class RolesUserRepository implements InterfaceRolesUsuarioRepository
{

    /**
     *
     * @param int $role_user_id
     * @return bool
     */
    public function deleteRoleUser(int $role_user_id): bool
    {
        return UserRole::find($role_user_id)->delete();
    }

    /**
     * @param int $role_user_id
     * @return bool
     */
    public function RoleUserExists($role_user_id): bool
    {
        return UserRole::find($role_user_id)->exists();
    }

    /**
     * @param int $role_id
     * @return bool
     */
    public function roleExist(int $role_id): bool
    {
        return Role::find($role_id)->exists();
    }

    /**
     *
     * @param int $role_user_id
     * @return array
     */
    public function findById(int $role_user_id): array
    {
        return UserRole::find($role_user_id)->toArray();
    }

    /**
     *
     * @param int $user_id
     * @return array
     */
    public function getRolesUsuarioById(int $user_id)
    {
        return UserRole::where("user_id", $user_id)->toArray();
    }

    /**
     *
     * @param int $user_id
     * @param int $role_id
     * @return bool
     */
    public function RoleAsignInUser(int $user_id, int $role_id): bool
    {
        return UserRole::where("user_id", $user_id)->where("role_id", $role_id)->exists();
    }

    /**
     *
     * @param array $roleUser
     * @return bool
     */
    public function saveRoleUser(array $roleUser): bool
    {
        return UserRole::save($roleUser);
    }

    /**
     *
     * @param int $role_user_id
     * @param array $roleUser
     * @return bool
     */
    public function updateRoleUser(int $role_user_id, array $roleUser): bool
    {
        return UserRole::update($roleUser);
    }
}
