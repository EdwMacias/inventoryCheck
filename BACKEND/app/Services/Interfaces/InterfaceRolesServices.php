<?php

namespace App\Services\Interfaces;

interface InterfaceRolesServices
{

    /**
     * @param  array $roleEntity
     */
    public function asignarUserRole($roleEntity);
    /**
     * @param  array $roleEntity
     */
    public function deleteUserRole($roleEntity);
    public function getUserRole();
    /**
     * @param array $roleEntity
     */
    public function updateUserRole($roleEntity);

}
