<?php

namespace App\Services\Services;

use App\Respositories\Interfaces\InterfaceDocumentTypeRepository;
use App\Respositories\Interfaces\InterfaceGenderRepository;
use App\Respositories\Interfaces\InterfaceUsuarioRepository;
use App\Services\Interfaces\InterfaceUsuarioServices;
use App\Utils\Encriptacion;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class UsuarioServices implements InterfaceUsuarioServices
{
    protected InterfaceUsuarioRepository $_usuarioRepository;
    protected InterfaceDocumentTypeRepository $_documentRepository;
    protected InterfaceGenderRepository $_genderRepository;

    public function __construct(InterfaceUsuarioRepository $_usuarioRepository, InterfaceDocumentTypeRepository $_documentRepository, InterfaceGenderRepository $_genderRepository)
    {
        $this->_usuarioRepository = $_usuarioRepository;
        $this->_documentRepository = $_documentRepository;
        $this->_genderRepository = $_genderRepository;
    }

    /**
     *@param $id
     * @param array $usuario
     *@return bool    
     */

    public function actualizarUsuario($id, array $usuario)
    {
        try {
            // Decrypt the ID
            $id = Encriptacion::getDescriptacion($id);

            // Check if the user exists
            $userExist = $this->_usuarioRepository->getUserByID($id);
            if (!$userExist) {
                throw new Exception("Usuario no se encuentra registrado", Response::HTTP_NOT_FOUND);
            }

            $documentType = $usuario["document_type_id"];

            if (!$this->_documentRepository->typeDocumentExist($documentType)) {
                throw new Exception("El documento elegido no existe", Response::HTTP_CONFLICT);
            }

            $genderId = $usuario["gender_id"];

            if (!$this->_genderRepository->genderExist($genderId)) {
                throw new Exception("El genero seleccionado no es valido", Response::HTTP_CONFLICT);
            }

            // Check if the email is already registered for another user
            $existingUserWithEmail = $this->_usuarioRepository->getUserByEmail($usuario["email"]);
            if ($existingUserWithEmail && $existingUserWithEmail->user_id != $id) {
                throw new Exception("Email ya registrado", Response::HTTP_CONFLICT);
            }

            // Update the user
            return $this->_usuarioRepository->updateUser($id, $usuario);
        } catch (\Throwable $th) {
            // Handle exceptions
            $statusCode = $th instanceof Exception ? $th->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR;
            throw new Exception($th->getMessage(), $statusCode);
        }
    }

    /**
     *@param array $usuario
     *@return bool
    //  * @param User $user
     */
    public function crearUsuario($usuario)
    {
        try {
            // Check if email already exists
            if ($this->_usuarioRepository->EmailExist($usuario["email"])) {
                throw new Exception("Correo ya registrado", Response::HTTP_CONFLICT);
            }

            $documentType = $usuario["document_type_id"];

            if (!$this->_documentRepository->typeDocumentExist($documentType)) {
                throw new Exception("El documento elegido no existe", Response::HTTP_CONFLICT);
            }

            $genderId = $usuario["gender_id"];

            if (!$this->_genderRepository->genderExist($genderId)) {
                throw new Exception("El genero seleccionado no es valido", Response::HTTP_CONFLICT);
            }


            $this->_usuarioRepository->createUser($usuario);

            return true;
        } catch (\Throwable $th) {
            // Handle exceptions
            $statusCode = $th instanceof Exception ? $th->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR;
            throw new Exception($th->getMessage(), $statusCode);
        }

    }

    /**
     *
     * @param string $id
     * @return bool
     */
    public function eliminarUsuario($id)
    {
        try {

            $usuarioExist = $this->_usuarioRepository->getUserByID($id);

            if ($usuarioExist) {
                throw new Exception("Usuario no registrado", Response::HTTP_CONFLICT);
            }

            return $this->_usuarioRepository->deleteUser($id);

        } catch (Exception $th) {
            $statusCode = $th instanceof Exception ? $th->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR;
            throw new Exception($th->getMessage(), $statusCode);
        }


    }

    /**
     */
    public function obtenerUsuarios()
    {
        throw new Exception("Error Processing Request", 1);

    }
}
