<?php

namespace App\Services\Services;

use App\Respositories\Interfaces\InterfaceUsuarioRepository;
use App\Services\Interfaces\InterfaceUsuarioServices;
use App\Utils\Encriptacion;
use App\Utils\ResponseHandler;
use App\Utils\Utilidades;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class UsuarioServices implements InterfaceUsuarioServices
{
    protected InterfaceUsuarioRepository $_usuarioRepository;

    public function __construct(InterfaceUsuarioRepository $_usuarioRepository)
    {
        $this->_usuarioRepository = $_usuarioRepository;
    }


    /**
     *@param $id
    //  * @param User $user
     */

    public function actualizarUsuario($id, $usuarioArray)
    {
        $id = Encriptacion::getDescriptacion($id);

        $usuario = $this->_usuarioRepository->getUserByID($id);

        if (!$usuario) {
            throw new Exception("Error Processing Request", 1);
        }

        $email = $this->_usuarioRepository->getUserByEmail($usuarioArray["email"]);

        if ($email && $email->user_id != $usuario->user_id) {
            throw new Exception("Email ya registrado", 1);
        }

        return $this->_usuarioRepository->updateUser($id, $usuarioArray);
    }

    /**
     *
    //  * @param User $user
     */
    public function crearUsuario($usuarioModel)
    {

        $BadRequestReponse = new ResponseHandler('', [], Response::HTTP_BAD_REQUEST);

        $usuario = $this->_usuarioRepository->getUserByEmail($usuarioModel["email"]);

        if ($usuario) {
            $BadRequestReponse->setMessage('Correo ya registrado');
            $BadRequestReponse->setData([]);
            return $BadRequestReponse->responses();
        }

        $respuesta = $this->_usuarioRepository->createUser($usuarioModel);

        if ($respuesta) {
            $GoodRequestResponse = new ResponseHandler('Usuario creado con exito', $respuesta, Response::HTTP_OK);
            return $GoodRequestResponse->responses();
        }

        $BadRequestReponse->setMessage('Usuario no fue creado');
        $BadRequestReponse->setData([]);
        return $BadRequestReponse->responses();

    }

    /**
     *
     * @param mixed $id
     */
    public function eliminarUsuario($id)
    {
        throw new Exception("Error Processing Request", 1);

    }

    /**
     */
    public function obtenerUsuarios()
    {
        throw new Exception("Error Processing Request", 1);

    }
}
