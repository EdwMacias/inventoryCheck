<?php

namespace App\Services\Services;

use App\Repositories\Interfaces\InterfaceRolesUsuarioRepository;
use App\Repositories\Interfaces\InterfaceUsuarioRepository;
use App\Services\Interfaces\InterfaceRolesServices;
use App\Utils\ResponseHandler;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class RolesServices implements InterfaceRolesServices
{
    private InterfaceUsuarioRepository $_usuarioRepository;
    private InterfaceRolesUsuarioRepository $_RolesRepository;
    public function __construct(InterfaceUsuarioRepository $interfaceUsuarioRepository, InterfaceRolesUsuarioRepository $interfaceRolesUsuarioRepository)
    {
        $this->_usuarioRepository = $interfaceUsuarioRepository;
        $this->_RolesRepository = $interfaceRolesUsuarioRepository;
    }
    /**
     *
     * @param array $roleEntity
     * @return ResponseHandler
     */
    public function asignarUserRole($roleEntity)
    {
        try {
            $roleEntityDto = [];
            $fields = ["user_id", "role_id"];

            foreach ($fields as $field) {
                $roleEntityDto[$field] = $roleEntity[$field];
            }

            if (!$this->_usuarioRepository->userExist($roleEntityDto["user_id"])) {
                throw new Exception("Usuario no encontrado", Response::HTTP_NOT_FOUND);
            }

            if (!$this->_RolesRepository->roleExist($roleEntityDto["role_id"])) {
                throw new Exception("Rol no encontrado", Response::HTTP_NOT_FOUND);
            }


            $this->_RolesRepository->saveRoleUser($roleEntityDto);

            return new ResponseHandler("Rol asignado con exito", [], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return new ResponseHandler($th->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $th) {
            return new ResponseHandler($th->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     *
     * @param array $roleEntity
     */
    public function deleteUserRole($roleEntity)
    {
        try {
            //code...
            $roleUserId = 1;

            if (!$this->_RolesRepository->RoleUserExists($roleUserId)) {
                throw new Exception("Rol de usuario no encontrado", Response::HTTP_NOT_FOUND);
            }

            $this->_RolesRepository->deleteRoleUser($roleUserId);

            return new ResponseHandler("Rol desasignado correctamente", [], Response::HTTP_OK);

        } catch (\Throwable $th) {
            return new ResponseHandler($th->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $th) {
            return new ResponseHandler($th->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     */
    public function getUserRole()
    {
    }

    /**
     *@param int $idUserRole
     * @param array $roleEntity
     */
    public function updateUserRole($roleEntity)
    {
    }
}
