<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
// use app\utils\ResponseHandler;
// use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\Users\User;
use App\Utils\ResponseHandler;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(LoginRequest $request)
    {
        $responseHandler = new ResponseHandler();

        $email = $request->input('email');
        $password = $request->input('password');

        $credentials = ["email" => $email, "password" => $password];

        $token = auth()->attempt($credentials);

        if (!$token) {
            $responseHandler->setMessage(["Credenciales Incorrectas"]);
            $responseHandler->setStatus(Response::HTTP_UNAUTHORIZED);
            return $responseHandler->responses();
        }

        if (auth()->user()->statu_id == 1) {
            $data = [
                'usuario' => auth()->user(),
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ];

            $responseHandler->setMessage("Inicio de sesión exitoso");
            $responseHandler->setData($data);
        } else {
            $responseHandler->setMessage("El usuario no se encuentra activo");
        }

        return $responseHandler->responses();
    }

    public function me()
    {
        $responseHandler = new ResponseHandler();
        $usuario = auth()->user();
        $resultado = User::find($usuario->getAuthIdentifier());
        $responseHandler->setData($resultado->getUserWithRelatedData());
        $responseHandler->setMessage('Informacion Usuario');
        $responseHandler->setStatus(Response::HTTP_OK);
        return $responseHandler->responses();
    }

    public function logout()
    {
        auth()->logout();
        $responseHandler = new ResponseHandler('Successfully logged out');
        return $responseHandler->responses();
    }

    public function refresh()
    {
        $responseHandler = new ResponseHandler('Token Refrescado');
        $token = auth()->refresh();

        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];

        $responseHandler->setData($data);
        $responseHandler->setStatus(Response::HTTP_OK);
        return $responseHandler->responses();

    }


}
