<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
// use app\utils\ResponseHandler;
// use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Http\Requests\UpdatePasswordRequest;
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

    public function login(LoginRequest $request)
    {
        $responseHandler = new ResponseHandler();

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $usuario = User::where('email', strtolower($credentials['email']))->first();

        $isPassword = Utilidades::VerificarPassword(strtolower($credentials['password']), $usuario->password);

        if (!$isPassword) {
            $responseHandler->setMessage(["Credenciales Incorrectas"]);
            $responseHandler->setStatus(Response::HTTP_UNAUTHORIZED);
            return $responseHandler->responses();
        }

        $token = auth()->login($usuario);

        if (auth()->user()->statu_id == 1) {

            $data = [
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
