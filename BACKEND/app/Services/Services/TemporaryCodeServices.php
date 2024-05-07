<?php

namespace App\Services\Services;

use App\Jobs\ProcesarCorreo;
use App\Mail\EmergencyCallReceived;
use App\Respositories\Interfaces\InterfaceTemporaryCode;
use App\Respositories\Interfaces\InterfaceUsuarioRepository;
use App\Services\Interfaces\InterfaceTemporaryCodeServices;
use App\Utils\ResponseHandler;
use Exception;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class TemporaryCodeServices implements InterfaceTemporaryCodeServices
{

    protected InterfaceUsuarioRepository $_usuarioRepository;
    protected InterfaceTemporaryCode $_temporaryCodeRepository;

    public function __construct(InterfaceUsuarioRepository $interfaceUsuarioRepository, InterfaceTemporaryCode $interfaceTemporaryCodeRepository)
    {
        $this->_temporaryCodeRepository = $interfaceTemporaryCodeRepository;
        $this->_usuarioRepository = $interfaceUsuarioRepository;
    }

    /**
     *
     * @param mixed $email
     */
    public function createCodeTemporary($email): ResponseHandler
    {
        try {
            $user = $this->_usuarioRepository->getUserByEmail($email);

            if (!$user) {
                throw new Exception("Correo no registrado", Response::HTTP_NOT_FOUND);
            }

            $this->_temporaryCodeRepository->cleanTemporaryCode($user->user_id);

            $temporaryCode = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);

            $temporaryCode = $this->_temporaryCodeRepository->createTemporaryCode($temporaryCode, $user->user_id);        

            $correo = new EmergencyCallReceived($temporaryCode);
            
            ProcesarCorreo::dispatch($email, $correo);

            return new ResponseHandler("Correo Enviado", [], Response::HTTP_OK);

        } catch (Throwable $th) {
            return new ResponseHandler($th->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $th) {
            return new ResponseHandler($th->getMessage(), [], $th->getCode());
        }
    }

    /**
     *
     * @param mixed $code
     */
    public function validateCodeTemporary($code)
    {
    }
}
