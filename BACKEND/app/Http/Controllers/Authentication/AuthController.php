<?php

namespace App\Http\Controllers\Authentication;

use App\DTOs\AuthenticationDTOs\LoginRequestDTO;
use App\DTOs\AuthenticationDTOs\LoginResponseDTO;
use App\DTOs\Usuario\UsuarioResponseDTO;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\InterfaceUsuarioRepository;
use App\Utils\ResponseHandler;
use App\Utils\Utilidades;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    protected InterfaceUsuarioRepository $usuarioRepository;

    public function __construct(InterfaceUsuarioRepository $interfaceUsuarioRepository)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->usuarioRepository = $interfaceUsuarioRepository;
    }

    public function login(LoginRequest $loginRequest)
    {
        $responseHandler = new ResponseHandler();

        $loginRequestDto = LoginRequestDTO::fromArray($loginRequest->all());

        $usuario = $this->usuarioRepository->getUserByEmail($loginRequestDto->email);

        if (!$usuario) {
            return $responseHandler
                ->setMessages("Usuario no registrado")
                ->setData(["error" => "Usuario no registrado"])
                ->setStatus(Response::HTTP_NOT_FOUND)->responses();
        }

        $isPassword = Utilidades::VerificarPassword($loginRequestDto->password, $usuario->password);

        if (!$isPassword) {
            return $responseHandler
                ->setMessages("Credenciales Incorrectas")
                ->setData(["error" => "Credenciales Incorrectas"])
                ->setStatus(Response::HTTP_UNAUTHORIZED)->responses();
        }

        auth()->login($usuario);

        if (auth()->user()->statu_id == 1) {
            $expires_in = auth()->factory()->getTTL() * 60;
            $loginResponseDTO = new LoginResponseDTO(auth()->login($usuario), 'bearer', $expires_in);
            return $responseHandler
                ->setMessages("Inicio de sesión exitoso")
                ->setData($loginResponseDTO->toArray())
                ->responses();
        }

        return $responseHandler
            ->setMessages("El usuario no se encuentra activo")
            ->setData(["error" => "El usuario no se encuentra activo"])
            ->setStatus(Response::HTTP_UNAUTHORIZED)
            ->responses();
    }

    public function me()
    {
        $responseHandler = new ResponseHandler();
        $usuario = auth()->user();
        $usuario = $this->usuarioRepository->getUserByID($usuario->getAuthIdentifier());
        $usuarioResponseDTO = UsuarioResponseDTO::fromArray($usuario->toArray())->toArray();
        return $responseHandler->setMessages("Usuario Authenticado")
            ->setData($usuarioResponseDTO)
            ->responses();
    }

    public function logout()
    {
        $responseHandler = new ResponseHandler('Conexión Terminada');
        auth()->logout();
        return $responseHandler->responses();
    }

    public function refresh()
    {
        $responseHandler = new ResponseHandler('Token Refrescado');

        $token = auth()->refresh();
        $expires_in = auth()->factory()->getTTL() * 60;

        $loginResponseDTO = new LoginResponseDTO($token, 'bearer', $expires_in);
        return $responseHandler->setData($loginResponseDTO->toArray())->responses();

    }

}
