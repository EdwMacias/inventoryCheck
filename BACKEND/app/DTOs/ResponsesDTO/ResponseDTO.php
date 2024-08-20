<?php

namespace App\DTOs\ResponsesDTO;
use Symfony\Component\HttpFoundation\Response;

class ResponseDTO
{
    /**
     * @var string|array<string> Mensaje(s) de la respuesta.
     */
    public string|array $messages;

    /**
     * @var mixed Datos asociados a la respuesta.
     */
    public $data;

    /**
     * @var int Código de estado HTTP de la respuesta.
     */
    public int $status;

    /**
     * Constructor de ResponseDTO.
     *
     * @param string|array<string> $messages Mensaje(s) de la respuesta.
     * @param mixed $data Datos asociados a la respuesta.
     * @param int $status Código de estado HTTP (por defecto: 200 OK).
     */
    public function __construct(string|array $messages = '', $data = [], int $status = Response::HTTP_OK)
    {
        $this->messages = $messages;
        $this->data = $data;
        $this->status = $status;
    }

}
