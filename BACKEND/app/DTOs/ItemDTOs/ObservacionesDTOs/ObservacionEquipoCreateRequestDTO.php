<?php

namespace App\DTOs\ItemDTOs\ObservacionesDTOs;
use Illuminate\Http\UploadedFile;

class ObservacionEquipoCreateRequestDTO
{
    public $observacion_equipo_id;
    public $equipo_id;
    public $fecha;
    public $asunto;
    public $actividad;
    public $estado;
    public $responsable;
    public string|UploadedFile $firma_responsable;
    public $proxima_actividad;
    public array $resource;
    public function __construct(array $observacionEquipoCreate)
    {
        // $this->observacion_equipo_id = uuid_create();
        $this->equipo_id = $observacionEquipoCreate['equipo_id'];
        $this->fecha = $observacionEquipoCreate['fecha'];
        $this->asunto = $observacionEquipoCreate['asunto'];
        $this->actividad = $observacionEquipoCreate['actividad'];
        $this->estado = $observacionEquipoCreate['estado'];
        $this->responsable = $observacionEquipoCreate['responsable'];
        $this->firma_responsable = $observacionEquipoCreate['firma_responsable'];
        $this->proxima_actividad = $observacionEquipoCreate['proxima_actividad'];
        $this->resource = $observacionEquipoCreate['resource'] ?? null;
    }
    public function toArray(): array
    {
        return [
            // "observacion_equipo_id" => $this->observacion_equipo_id,
            "equipo_id" => $this->equipo_id,
            "fecha" => $this->fecha,
            "asunto" => $this->asunto,
            "actividad" => $this->actividad,
            "estado" => $this->estado,
            "responsable" => $this->responsable,
            "firma_responsable" => $this->firma_responsable,
            "proxima_actividad" => $this->proxima_actividad
        ];
    }
}
