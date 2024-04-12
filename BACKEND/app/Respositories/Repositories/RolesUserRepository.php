<?php

namespace App\Respositories\Repositories;

use App\Models\Users\UserRole;
use App\Respositories\Interfaces\InterfaceRolesUsuarioRepository;

class RolesUserRepository extends UserRole implements InterfaceRolesUsuarioRepository
{

    /**
     *
     * @param int $role_user_id
     * @return bool
     */
    public function deleteRoleUser(int $role_user_id): bool
    {
        return parent::find($role_user_id)->delete();
    }

    /**
     *
     * @param int $role_user_id
     * @return array
     */
    public function findById(int $role_user_id): array
    {
        return parent::find($role_user_id)->toArray();
    }

    /**
     *
     * @param int $user_id
     * @return array
     */
    public function getRolesUsuarioById(int $user_id)
    {
        return parent::where("user_id", $user_id)->toArray();
    }

    /**
     *
     * @param int $user_id
     * @param int $role_id
     * @return bool
     */
    public function RoleAsignInUser(int $user_id, int $role_id): bool
    {
        return parent::where("user_id", $user_id)->where("role_id", $role_id)->exists();
    }

    /**
     *
     * @param array $roleUser
     * @return bool
     */
    public function saveRoleUser(array $roleUser): bool
    {
        return parent::save($roleUser);
    }

    /**
     *
     * @param int $role_user_id
     * @param array $roleUser
     * @return bool
     */
    public function updateRoleUser(int $role_user_id, array $roleUser): bool
    {
        return parent::update($roleUser);
    }
}
