<?php

namespace App\DTOs\Terceros\Tercero\PersonaNatural;

class PersonaNaturalCreateDTO
{

    public string $primerNombre;
    public ?string $segundoNombre = null;
    public string $primerApellido;
    public ?string $segundoApellido = null;
    public string $tipoIdenticacionId;
    public string $numeroIdentificacion;
    public string $telefono;
    public ?string $correo = null;
    public string $direccion;
    public string $departamento;
    public string $ciudad;
    public ?string $dv = null;

    public function __construct($personaNatural = null)
    {
        $this->primerNombre = $this->sanitizeString($personaNatural->primerNombre ?? null);
        $this->segundoNombre = $this->sanitizeString($personaNatural->segundoNombre ?? null);
        $this->primerApellido = $this->sanitizeString($personaNatural->primerApellido ?? null);
        $this->segundoApellido = $this->sanitizeString($personaNatural->segundoApellido ?? null);
        $this->tipoIdenticacionId = $this->sanitizeString($personaNatural->tipoIdentificacion ?? null);
        $this->numeroIdentificacion = $this->sanitizeNumber($personaNatural->numeroIdentificacion ?? null);
        $this->telefono = $this->sanitizeNumber($personaNatural->telefono ?? null);
        $this->correo = $this->sanitizeEmail($personaNatural->correo ?? null);
        $this->direccion = $this->sanitizeString($personaNatural->direccion ?? null);
        $this->departamento = $this->sanitizeString($personaNatural->departamento ?? null);
        $this->ciudad = $this->sanitizeString($personaNatural->ciudad ?? null);
        $this->dv = $this->sanitizeString($personaNatural->dv ?? null);
    }


    public function toArray()
    {
        return [
            'primer_nombre' => $this->primerNombre,
            'segundo_nombre' => $this->segundoNombre,
            'primer_apellido' => $this->primerApellido,
            'segundo_apellido' => $this->segundoApellido,
            'document_type_id' => $this->tipoIdenticacionId,
            'numero_identificacion' => $this->numeroIdentificacion,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'departamento' => $this->departamento,
            'ciudad' => $this->ciudad,
            'dv' => $this->dv
        ];
    }

    private function sanitizeString(?string $value): ?string
    {
        return $value ? filter_var(trim($value), FILTER_SANITIZE_STRING) : null;
    }

    private function sanitizeNumber(?string $value): ?string
    {
        return $value ? preg_replace('/[^0-9]/', '', $value) : null;
    }

    private function sanitizeEmail(?string $value): ?string
    {
        return $value ? filter_var(trim($value), FILTER_SANITIZE_EMAIL) : null;
    }

}
