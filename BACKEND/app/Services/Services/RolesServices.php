<?php

namespace App\Services\Services;

use App\DTOs\RolesDTOs\RoleRequestDTO;
use App\DTOs\RolesDTOs\RoleUserDTO;
use App\DTOs\Usuario\UsuarioResponseDTO;
use App\Repositories\Interfaces\InterfaceRolesUserRepository;
use App\Repositories\Interfaces\InterfaceUsuarioRepository;
use App\Services\Interfaces\InterfaceRolesServices;
use App\Utils\ResponseHandler;
use Exception;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class RolesServices implements InterfaceRolesServices
{
    private InterfaceUsuarioRepository $_usuarioRepository;
    private InterfaceRolesUserRepository $_roleUserRepository;
    public function __construct(
        InterfaceUsuarioRepository $interfaceUsuarioRepository,
        InterfaceRolesUserRepository $interfaceRolesUsuarioRepository
    ) {
        $this->_usuarioRepository = $interfaceUsuarioRepository;
        $this->_roleUserRepository = $interfaceRolesUsuarioRepository;
    }
    /**
     * Asignar rol al usuario
     * @param RoleRequestDTO $roleRequestDTO
     * @return \Illuminate\Http\JsonResponse
     */
    public function assign(RoleRequestDTO $roleRequestDTO)
    {
        $responseHandler = new ResponseHandler();

        try {

            $usuario = $this->_usuarioRepository->getUserByEmail($roleRequestDTO->email);

            $usuarioDTO = UsuarioResponseDTO::fromArray($usuario->toArray());

            if (!$usuario) {
                throw new Exception("Correo no encontrado", Response::HTTP_NOT_FOUND);
            }

            if (!$this->_roleUserRepository->roleExist($roleRequestDTO->email)) {
                throw new Exception("El rol no existe", Response::HTTP_NOT_FOUND);
            }

            $roleUserDTO = new RoleUserDTO($roleRequestDTO->email, $usuarioDTO->user_id);

            $this->_roleUserRepository->save($roleUserDTO);

            return $responseHandler->setData(true)->setMessages("Rol asignado")->responses();

        } catch (\Throwable $th) {
            return $responseHandler->handleException($th);
        } catch (Exception $ex) {
            return $responseHandler->handleException($ex);
        }

    }
    /**
     * Elimina rol a un usuario
     * @param  string $roleEntity
     */
    public function deleteUserRole(string $user_role_id)
    {
        $responseHandler = new ResponseHandler();
        try {
            if (!$this->_roleUserRepository->existUserRoleId($user_role_id)) {
                throw new Exception("El rol asignado no existe", 1);
            }

            $this->_roleUserRepository->delete($user_role_id);

            return $responseHandler->setData(true)->setMessages("Rol de usuario eliminado")->responses();
        } catch (\Throwable $th) {
            return $responseHandler->handleException($th);
        } catch (QueryException $qe) {
            return $responseHandler->handleException($qe);
        } catch (Exception $e) {
            return $responseHandler->handleException($e);
        }
    }

    /**
     * obtener role del usuario
     * @param string $email
     */
    public function getRoleUsuario(string $email)
    {
        $responseHandler = new ResponseHandler();

        try {
            //code...
            $usuario = $this->_usuarioRepository->getUserByEmail($email);

            if (!$usuario) {
                throw new Exception("Usuario no encontrado", Response::HTTP_NOT_FOUND);
            }

            $usuarioDTO = UsuarioResponseDTO::fromArray($usuario->toArray());

            $roleUser = $this->_roleUserRepository->getRoleUser($usuarioDTO->user_id);

            if (!$roleUser) {
                throw new Exception("Usuario no tiene roles asignados", Response::HTTP_NOT_FOUND);
            }


            $roleUserDTO = RoleUserDTO::fromArray($roleUser->toArray());

            $roleUser = $this->_roleUserRepository->getRole($roleUserDTO->role_id);

            if (!$roleUser) {
                throw new Exception("Rol no encontrado", Response::HTTP_NOT_FOUND);
            }

            return $responseHandler->setData($roleUser->toArray())->setMessages('Rol de usuario encontrado')->responses();

        } catch (\Throwable $th) {
            return $responseHandler->handleException($th);
        } catch (Exception $e) {
            return $responseHandler->handleException($e);
        } catch (QueryException $qe) {
            return $responseHandler->handleException($qe);
        }
    }


}
