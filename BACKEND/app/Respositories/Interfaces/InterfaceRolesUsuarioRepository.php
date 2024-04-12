<?php

namespace App\Respositories\Interfaces;

use App\Models\Users\UserRole;

interface InterfaceRolesUsuarioRepository
{
    public function findById(int $role_user_id): array;
    public function RoleAsignInUser(int $user_id, int $role_id): bool;
    public function saveRoleUser(array $roleUser): bool;
    public function getRolesUsuarioById(int $user_id);
    public function updateRoleUser(int $role_user_id, array $roleUser): bool;
    public function deleteRoleUser(int $role_user_id): bool;
}