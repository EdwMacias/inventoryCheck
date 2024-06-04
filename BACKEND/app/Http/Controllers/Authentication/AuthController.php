<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\ResponseHandler;
use App\Utils\Utilidades;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(LoginRequest $loginRequest)
    {
        $responseHandler = new ResponseHandler();

        $usuario = User::where('email', strtolower($loginRequest['email']))->first();

        $isPassword = Utilidades::VerificarPassword(strtolower($loginRequest['password']), $usuario->password);

        if (!$isPassword) {
            return $responseHandler->setMessages("Credenciales Incorrectas")->setStatus(Response::HTTP_UNAUTHORIZED)->responses();
        }
        auth()->login($usuario);

        if (auth()->user()->statu_id == 1) {

            $data = [
                'access_token' => auth()->login($usuario),
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ];

            return $responseHandler->setMessages("Inicio de sesión exitoso")->setData($data)->responses();
        }
        return $responseHandler->setMessages("El usuario no se encuentra activo")->responses();
    }

    public function me()
    {
        $usuario = auth()->user();
        $resultado = User::find($usuario->getAuthIdentifier())->toArray();
        $response = new ResponseHandler('Usuario Auntenticado', $resultado);
        return $response->responses();
    }

    public function logout()
    {
        auth()->logout();
        $responseHandler = new ResponseHandler('Successfully logged out');
        return $responseHandler->responses();
    }

    public function refresh()
    {
        $token = auth()->refresh();

        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];

        $responseHandler = new ResponseHandler('Token Refrescado', $data);
        return $responseHandler->responses();

    }




}
