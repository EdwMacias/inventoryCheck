<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
// use app\utils\ResponseHandler;
// use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

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
            $responseHandler->setMessage(["Incorrect Credentials"]);
            $responseHandler->setStatus(Response::HTTP_UNAUTHORIZED);
            return $responseHandler->responses();
        }

        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];

        $responseHandler->setMessage(["Inicio de sesión exitoso"]);
        $responseHandler->setData($data);

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
        $responseHandler = new ResponseHandler('Token Refrescado', auth()->refresh());
        return $responseHandler->responses();
    }


}
