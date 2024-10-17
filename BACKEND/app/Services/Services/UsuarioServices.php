<?php

namespace App\Services\Services;

use App\DTOs\Usuario\UsuarioCreateDTO;
use App\DTOs\Usuario\UsuarioResponseDTO;
use App\DTOs\Usuario\UsuarioUpdateDTO;
use App\Repositories\Interfaces\InterfaceDocumentTypeRepository;
use App\Repositories\Interfaces\InterfaceGenderRepository;
use App\Repositories\Interfaces\InterfaceUsuarioRepository;
use App\Repositories\Repositories\TemporaryCodeRepository;
use App\Services\Interfaces\InterfaceUsuarioServices;
use App\Utils\ResponseHandler;
use App\Utils\TablesServerSide;
use App\Utils\Utilidades;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class UsuarioServices implements InterfaceUsuarioServices
{
    private InterfaceDocumentTypeRepository $_documentRepository;
    private InterfaceGenderRepository $_genderRepository;
    private InterfaceUsuarioRepository $_usuarioRepository;
    private TemporaryCodeRepository $_temporaryCodeRepository;

    public function __construct(
        InterfaceDocumentTypeRepository $documentRepository,
        InterfaceGenderRepository $genderRepository,
        InterfaceUsuarioRepository $usuarioRepository,
        TemporaryCodeRepository $temporaryCodeRepository
    ) {
        $this->_documentRepository = $documentRepository;
        $this->_genderRepository = $genderRepository;
        $this->_usuarioRepository = $usuarioRepository;
        $this->_temporaryCodeRepository = $temporaryCodeRepository;
    }

    /**
     *@param string $userId
     * @param UsuarioCreateDTO $usuario
     *@return JsonResponse    
     */

    public function actualizarUsuario(string $userId, UsuarioCreateDTO $usuarioCreateDTO): JsonResponse
    {
        $responseHandler = new ResponseHandler();
        try {

            $usuario = $this->_usuarioRepository->getUserByID($userId);
            $usuarioUpdateDTO = UsuarioUpdateDTO::fromArray($usuario->toArray());

            if (!$usuario) {
                throw new Exception("Usuario no se encuentra registrado", Response::HTTP_NOT_FOUND);
            }

            if (!$this->_documentRepository->typeDocumentExist($usuarioCreateDTO->document_type_id)) {
                throw new Exception("El documento elegido no existe", Response::HTTP_CONFLICT);
            }

            if (!$this->_genderRepository->genderExist($usuarioCreateDTO->gender_id)) {
                throw new Exception("El genero seleccionado no es valido", Response::HTTP_CONFLICT);
            }

            $usuarioComparacionDTO = $this->_usuarioRepository->getUserByEmail($usuarioCreateDTO->email);

            if ($usuarioComparacionDTO) {
                $usuarioComparacionDTO = UsuarioUpdateDTO::fromArray($usuarioComparacionDTO->toArray());
                if ($usuarioComparacionDTO->user_id != $usuarioUpdateDTO->user_id) {
                    throw new Exception("Email ya registrado", Response::HTTP_CONFLICT);
                }
            }
            $usuarioUpdateDTO = $usuarioUpdateDTO->fromArrayUpdate($usuarioCreateDTO->toArray());

            $this->_usuarioRepository->updateUser($usuarioUpdateDTO->user_id, $usuarioUpdateDTO);

            return $responseHandler->setData(true)->setMessages("Usuario actualizado")->responses();

        } catch (Exception $th) {
            return $responseHandler->handleException($th);
        } catch (QueryException $queryException) {
            return $responseHandler->handleException($queryException);
        }
    }

    /**
     * @param UsuarioCreateDTO $usuarioCreateDTO
     * @return \Illuminate\Http\JsonResponse
     */
    public function crearUsuario(UsuarioCreateDTO $usuarioCreateDTO): JsonResponse
    {
        $responseHandle = new ResponseHandler();
        try {

            if ($this->_usuarioRepository->EmailExist($usuarioCreateDTO->email)) {
                throw new Exception("Correo ya registrado", Response::HTTP_CONFLICT);
            }

            if (!$this->_documentRepository->typeDocumentExist($usuarioCreateDTO->document_type_id)) {
                throw new Exception("El documento elegido no existe", Response::HTTP_CONFLICT);
            }

            if (!$this->_genderRepository->genderExist($usuarioCreateDTO->gender_id)) {
                throw new Exception("El genero seleccionado no es valido", Response::HTTP_CONFLICT);
            }

            $usuarioCreateDTO->password = Utilidades::EncriptarPassword(env('PASSWORD_USERS_DEFAULT'));

            $this->_usuarioRepository->createUser($usuarioCreateDTO);

            return $responseHandle->setData(true)->setMessages("Usuario Creado")->responses();
        } catch (Exception $th) {
            return $responseHandle->handleException($th);
        }

    }

    public function obtenerUsuarios()
    {
        $request = Request::capture();
        $userId = auth()->user()->getAuthIdentifier();

        try {
            $sql = "SELECT
                    users.*,
                    roles.name AS role
                FROM
                    users
                LEFT JOIN user_roles ON user_roles.user_id = users.user_id
                LEFT JOIN roles ON roles.role_id = user_roles.role_id
                WHERE users.user_id <> $userId";

            $fields = [
                "name",
                "email",
                "last_name",
                "number_document",
                "number_telephone",
                "statu_id",
                "role"
            ];

            $table = new TablesServerSide($sql, $request, $fields);
            $query = $table->crateBySql();
            return $table->getterTable($query);
        } catch (Throwable $th) {
            $response = new ResponseHandler($th->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
            return $response->responses();
        }
    }

    /**
     *
     * @param string $code
     * @param array $usuario
     * @return ResponseHandler
     */
    public function updatePassword($code, array $usuario)
    {

        try {

            $usuarioModel = $this->_usuarioRepository->getUserByEmail($usuario["email"]);

            if (!$usuarioModel) {
                throw new Exception("Usuario no encontrado", Response::HTTP_NOT_FOUND);
            }

            $usuarioUpdateDto = UsuarioUpdateDTO::fromArray($usuarioModel->toArray());

            $code = $this->_temporaryCodeRepository->temporaryCodeValidWhitUser($code, $usuarioUpdateDto->user_id);

            if (!$code) {
                throw new Exception("Codigo Invalido", Response::HTTP_NOT_ACCEPTABLE);
            }

            $code->is_used = true;
            $code->save();
            // $password = $usuario["password"];
            $usuarioUpdateDto->password = Utilidades::EncriptarPassword($usuario["password"]);

            $this->_usuarioRepository->updateUser($usuarioUpdateDto->user_id, $usuarioUpdateDto);
            $this->_temporaryCodeRepository->cleanTemporaryCode($usuarioUpdateDto->user_id);

            return new ResponseHandler("Contraseña Actualizada Correctamente", null, Response::HTTP_OK);

        } catch (Throwable $th) {
            return new ResponseHandler($th->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $th) {
            return new ResponseHandler($th->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    /**
     *
     * @param string $userId
     * Id del usuario a buscar
     * @return JsonResponse
     */
    public function obtenerUsuarioId($userId): JsonResponse
    {
        $responseHandler = new ResponseHandler();
        try {

            $usuario = $this->_usuarioRepository->getUserByEmail($userId);

            if (!$usuario) {
                throw new Exception("Usuario no encontrado", Response::HTTP_NOT_FOUND);
            }

            $usuarioResponseDTO = UsuarioResponseDTO::fromArray($usuario->toArray());

            return $responseHandler->setMessages("Usuario Encontrado")
                ->setData($usuarioResponseDTO->toArray())->responses();

        } catch (Throwable $th) {
            return $responseHandler->handleException($th);
        } catch (Exception $e) {
            return $responseHandler->handleException($e);
        }
    }
    /**
     *
     * @param string $userId Id del usuario a inactivar
     * @return JsonResponse
     */
    public function inactivar(string $userId): JsonResponse
    {
        $responseHandler = new ResponseHandler();
        try {

            $usuario = $this->_usuarioRepository->getUserByEmail($userId);

            if (!$usuario) {
                throw new Exception("Usuario no encontrado", Response::HTTP_NOT_FOUND);
            }

            $usuarioUpdateDTO = UsuarioUpdateDTO::fromArray($usuario->toArray());
            $usuarioUpdateDTO->statu_id = 2;

            $this->_usuarioRepository->updateUser($usuarioUpdateDTO->user_id, $usuarioUpdateDTO);
            return $responseHandler->setData(true)->setMessages("Usuario Inactivado")->responses();

        } catch (Exception $th) {
            return $responseHandler->handleException($th);
        }
    }
    /**
     *
     * @param string $userId Id del usuario a activar
     * @return JsonResponse
     */
    public function activar(string $userId): JsonResponse
    {
        $responseHandler = new ResponseHandler();
        try {

            $usuario = $this->_usuarioRepository->getUserByEmail($userId);

            if (!$usuario) {
                throw new Exception("Usuario no encontrado", Response::HTTP_NOT_FOUND);
            }

            $usuarioUpdateDTO = UsuarioUpdateDTO::fromArray($usuario->toArray());
            $usuarioUpdateDTO->statu_id = 1;

            $this->_usuarioRepository->updateUser($usuarioUpdateDTO->user_id, $usuarioUpdateDTO);
            return $responseHandler->setData(true)->setMessages("Usuario Activada")->responses();

        } catch (Exception $th) {
            return $responseHandler->handleException($th);
        }
    }
}
