<?php

namespace App\Http\Controllers\Role;

use App\DTOs\RolesDTOs\RoleRequestDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\RolesRequest;
use App\Services\Interfaces\InterfaceRolesServices;

class RolesUserController extends Controller
{
    protected InterfaceRolesServices $_roleService;
    public function __construct(InterfaceRolesServices $interfaceRolesServices)
    {
        $this->middleware('auth:api');
        $this->_roleService = $interfaceRolesServices;
    }

    /**
     * Asigna un rol a un usuario
     * @param RolesRequest $rolesRequest
     */
    public function assing(RolesRequest $rolesRequest)
    {
        $rolesRequestDTO = RoleRequestDTO::fromArray($rolesRequest->all());
        return $this->_roleService->assign($rolesRequestDTO);
    }

    /**
     * Elimina el rol de un usuario
     * @param string $id
     */
    public function unassign(string $id)
    {
        return $this->_roleService->deleteUserRole($id);
    }

    /**
     * Recupera rol del usuario
     */
    public function getRoleUsuario()
    {
        return $this->_roleService->getRoleUsuario();
    }

    public function get(){
        return $this->_roleService->getRolesUser();
    }
}
