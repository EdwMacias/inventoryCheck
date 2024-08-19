<?php

namespace App\DTOs\ItemDTOs\ObservacionesDTOs;
use App\DTOs\ResourceDTOs\ResourcesResponseDTO;

class ObservacionEquipoResponseDTO
{

    public $observacion_equipo_id;
    public $equipo_id;
    public $fecha;
    public $asunto;
    public $actividad;
    public $estado;
    public $responsable;
    public $firma_responsable;
    public $proxima_actividad;
    public $created_at;
    public $updated_at;
    public $resources;

    public function __construct($observaciones)
    {

        $this->observacion_equipo_id = $observaciones->observacion_equipo_id;
        $this->equipo_id = $observaciones->equipo_id;
        $this->fecha = $observaciones->fecha;
        $this->asunto = $observaciones->asunto;
        $this->actividad = $observaciones->actividad;
        $this->estado = $observaciones->estado;
        $this->responsable = $observaciones->responsable;
        $resources = [];
        foreach ($observaciones->equipo->observaciones->resources ?? [] as $resource) {
            $resources[] = new ResourcesResponseDTO($resource);
        }
        $this->resources = $resources;
        $this->firma_responsable = url($observaciones->firma_responsable);
        $this->proxima_actividad = $observaciones->proxima_actividad;
        $this->created_at = $observaciones->created_at;
        $this->updated_at = $observaciones->updated_at;
    }

}
