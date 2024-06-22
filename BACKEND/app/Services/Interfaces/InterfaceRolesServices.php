<?php

namespace App\Services\Interfaces;

use App\DTOs\RolesDTOs\RoleRequestDTO;

interface InterfaceRolesServices
{

    /**
     * Asigna rol a un usuario
     * @param RoleRequestDTO $roleRequestDTO
     */
    public function assign(RoleRequestDTO $roleRequestDTO);
    /**
     * Elimina rol a un usuario
     * @param  string $roleEntity
     */
    public function deleteUserRole(string $user_role_id);

    /**
     * obtener role del usuario
     * @param string $email
     */
    public function getRoleUsuario(string $email);

}
