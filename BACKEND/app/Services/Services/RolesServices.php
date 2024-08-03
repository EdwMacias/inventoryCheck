<?php

namespace App\Services\Services;

use App\DTOs\RolesDTOs\RoleRequestDTO;
use App\DTOs\RolesDTOs\RoleUserDTO;
use App\DTOs\Usuario\UsuarioResponseDTO;
use App\Repositories\Interfaces\InterfaceRolesUserRepository;
use App\Repositories\Interfaces\InterfaceUsuarioRepository;
use App\Services\Interfaces\InterfaceRolesServices;
use App\Utils\ResponseHandler;
use App\Utils\TablesServerSide;
use Exception;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Throwable;

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

            if (!$this->_roleUserRepository->roleInUser('1', auth()->user()->user_id)) {
                throw new Exception("No tiene permisos para realizar esta acción", Response::HTTP_UNAUTHORIZED);
            }

            $usuario = $this->_usuarioRepository->getUserByEmail($roleRequestDTO->email);

            $usuarioDTO = UsuarioResponseDTO::fromArray($usuario->toArray());


            if (!$usuario) {
                throw new Exception("Correo no encontrado", Response::HTTP_NOT_FOUND);
            }

            if (!$this->_roleUserRepository->roleExist($roleRequestDTO->role_id)) {
                throw new Exception("El rol no existe", Response::HTTP_NOT_FOUND);
            }

            $roleUser = $this->_roleUserRepository->getRoleUser($usuarioDTO->user_id);
            $roleUserDTO = new RoleUserDTO($roleRequestDTO->role_id, $usuarioDTO->user_id);

            if ($roleUser) {
                if ($roleUser->user_id == auth()->user()->user_id) {
                    throw new Exception("No puede modificar sus roles", Response::HTTP_UNAUTHORIZED);
                }
                $this->_roleUserRepository->updateUserRole($roleUser->user_role_id, $roleUserDTO);
            } else {
                $this->_roleUserRepository->save($roleUserDTO);
            }

            return $responseHandler->setData(true)->setMessages("Rol asignado")->responses();

        } catch (Throwable $th) {
            if ($th->getCode() === '0' || $th->getCode() === 0) {
                # code...
                return $responseHandler->handleException($th);

            }
            return $responseHandler->handleException($th, $th->getCode());
        } catch (Exception $ex) {
            if ($ex->getCode() === '0' || $ex->getCode() === 0) {
                # code...
                return $responseHandler->handleException($ex);

            }
            return $responseHandler->handleException($ex, $ex->getCode());
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

            $user_id = auth()->user()->user_id;

            if (!$this->_roleUserRepository->roleInUser('1', $user_id)) {
                throw new Exception("No tiene permisos para realizar esta acción", Response::HTTP_UNAUTHORIZED);
            }



            $usuario = $this->_usuarioRepository->getUserByEmail($user_role_id);
            $usuarioDTO = UsuarioResponseDTO::fromArray($usuario->toArray());

            $roleUser = $this->_roleUserRepository->getRoleUser($usuarioDTO->user_id);
            $user_role_id = $roleUser->user_role_id;

            if (!$this->_roleUserRepository->existUserRoleId($user_role_id)) {
                throw new Exception("El rol asignado no existe", Response::HTTP_NOT_FOUND);
            }

            if ($roleUser->user_id == auth()->user()->user_id) {
                throw new Exception("No puedes des-asginar tus roles", Response::HTTP_NOT_FOUND);
            }

            $this->_roleUserRepository->delete($user_role_id);

            return $responseHandler->setData(true)->setMessages("Rol de usuario eliminado")->responses();

        } catch (Throwable $th) {
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
    public function getRoleUsuario()
    {
        $responseHandler = new ResponseHandler();

        try {
            $roleUser = $this->_roleUserRepository->getRoleUser(auth()->user()->user_id);

            if (!$roleUser) {
                throw new Exception("Usuario no tiene roles asignados", Response::HTTP_NOT_FOUND);
            }

            $roleUserDTO = RoleUserDTO::fromArray($roleUser->toArray());

            $roleUser = $this->_roleUserRepository->getRole($roleUserDTO->role_id);

            if (!$roleUser) {
                throw new Exception("Rol no encontrado", Response::HTTP_NOT_FOUND);
            }

            return $responseHandler->setData($roleUser->toArray())->setMessages('Rol de usuario encontrado')->responses();

        } catch (Throwable $th) {
            return $responseHandler->handleException($th, $th->getCode());
        } catch (Exception $e) {
            return $responseHandler->handleException($e);
        } catch (QueryException $qe) {
            return $responseHandler->handleException($qe);
        }
    }

    public function getRolesUser()
    {
        $request = Request::capture();

        if (!$this->_roleUserRepository->roleInUser('1', auth()->user()->user_id)) {
            throw new Exception("No tiene permisos para realizar esta acción", Response::HTTP_UNAUTHORIZED);
        }

        try {
            $fields = [
                "user_role_id",
                "role_name",
                "user_name",
            ];
            $table = new TablesServerSide("user_roles_view", $request, $fields);
            $query = $table->createTable();
            return $table->getterTable($query);
        } catch (Throwable $th) {
            $response = new ResponseHandler($th->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
            return $response->responses();
        }
    }

    /**
     * @inheritDoc
     */
    public function getRoleUsuarioByEmail($email)
    {
        $responseHandler = new ResponseHandler();
        try {

            $usuario = $this->_usuarioRepository->getUserByEmail($email);

            $usuarioDTO = UsuarioResponseDTO::fromArray($usuario->toArray());

            $roleUser = $this->_roleUserRepository->getRoleUser($usuarioDTO->user_id);

            if (!$roleUser) {
                return $responseHandler->setData(['name' => null])
                    ->setMessages('Sin rol asignado')->responses();
            }

            $roleUserDTO = RoleUserDTO::fromArray($roleUser->toArray());

            $roleUser = $this->_roleUserRepository->getRole($roleUserDTO->role_id);



            if (!$roleUser) {
                throw new Exception("Rol no encontrado", Response::HTTP_NOT_FOUND);
            }

            return $responseHandler->setData($roleUser->toArray())->setMessages('Rol de usuario encontrado')->responses();
        } catch (Exception $e) {
            return $responseHandler->handleException($e);
        } catch (QueryException $qe) {
            return $responseHandler->handleException($qe);
        }
    }
}
