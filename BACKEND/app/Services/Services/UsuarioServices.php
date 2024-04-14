<?php

namespace App\Services\Services;

use App\Respositories\Interfaces\InterfaceDocumentTypeRepository;
use App\Respositories\Interfaces\InterfaceGenderRepository;
use App\Respositories\Interfaces\InterfaceUsuarioRepository;
use App\Services\Interfaces\InterfaceUsuarioServices;
use App\Utils\Encriptacion;
use App\Utils\ResponseHandler;
use App\Utils\TablesServerSide;
use App\Utils\Utilidades;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class UsuarioServices implements InterfaceUsuarioServices
{
    private InterfaceDocumentTypeRepository $_documentRepository;
    private InterfaceGenderRepository $_genderRepository;
    private InterfaceUsuarioRepository $_usuarioRepository;

    public function __construct(
        InterfaceDocumentTypeRepository $documentRepository,
        InterfaceGenderRepository $genderRepository,
        InterfaceUsuarioRepository $usuarioRepository
    ) {
        $this->_documentRepository = $documentRepository;
        $this->_genderRepository = $genderRepository;
        $this->_usuarioRepository = $usuarioRepository;
    }

    /**
     *@param $id
     * @param array $usuario
     *@return ResponseHandler    
     */

    public function actualizarUsuario($id, array $usuario): ResponseHandler
    {
        try {

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

            $fields = [
                "name",
                "email",
                "gender_id",
                "last_name",
                "number_document",
                "address",
                "number_telephone",
                "document_type_id"
            ];

            $UsuarioDto = [];

            foreach ($fields as $field) {
                $UsuarioDto[$field] = $usuario[$field];
            }

            $this->_usuarioRepository->updateUser($id, $UsuarioDto);

            return new ResponseHandler("Usuario Actualizado Exitosamente", Response::HTTP_OK);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), $th->getCode());
        }
    }

    /**
     *@param array $usuario
     * @return ResponseHandler
     */
    public function crearUsuario($usuario): ResponseHandler
    {
        // return $usuario;
        try {

            if ($this->_usuarioRepository->EmailExist($usuario["email"])) {
                throw new Exception("Correo ya registrado", Response::HTTP_CONFLICT);
            }

            // return $this->_usuarioRepository->EmailExist($usuario["email"]);
            $documentType = $usuario["document_type_id"];

            if (!$this->_documentRepository->typeDocumentExist($documentType)) {
                throw new Exception("El documento elegido no existe", Response::HTTP_CONFLICT);
            }

            $genderId = $usuario["gender_id"];

            if (!$this->_genderRepository->genderExist($genderId)) {
                throw new Exception("El genero seleccionado no es valido", Response::HTTP_CONFLICT);
            }

            $fields = [
                "name",
                "email",
                "gender_id",
                "last_name",
                "number_document",
                "password",
                "address",
                "number_telephone",
                "document_type_id"
            ];

            $usuario["password"] = Utilidades::EncriptarPassword("123@Cuatro");
            $UsuarioDto = [];

            foreach ($fields as $field) {
                $UsuarioDto[$field] = $usuario[$field];
            }

            $this->_usuarioRepository->createUser($UsuarioDto);

            return new ResponseHandler("Usuario Creado Exitosamente", Response::HTTP_OK);
        } catch (\Throwable $th) {
            // return $th->getCode();
            return new ResponseHandler($th->getMessage(), [], $th->getCode());
        }

    }

    /**
     *
     * @param string $id
     * @return ResponseHandler
     */
    public function eliminarUsuario($id)
    {
        try {

            $usuarioExist = $this->_usuarioRepository->getUserByID($id);

            if (!$usuarioExist) {
                throw new Exception("Usuario no registrado", Response::HTTP_CONFLICT);
            }
            $usuarioDto = [
                "statu_id" => $usuarioExist->statu_id == 1 ? 2 : 1
            ];

            
            $this->_usuarioRepository->updateUser($id, $usuarioDto);
            return new ResponseHandler("Usuario Eliminado Correctamente",$usuarioDto);
            
        } catch (Exception $th) {
            // return $th->getMessage();
            return new ResponseHandler($th->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     */
    public function obtenerUsuarios()
    {
        try {

            $fields = [
                "name",
                "email",
                "last_name",
                "number_document",
                "number_telephone",
            ];

            $table = new TablesServerSide("users", $fields);
            $query = $table->createTable();
            return $table->getterTable($query);
        } catch (\Throwable $th) {
            $response = new ResponseHandler($th->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
            return $response->responses();
        }

    }
}
