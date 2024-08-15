<?php

namespace App\DTOs\ItemDTOs\ObservacionesDTOs;

class ObservacionEquipoDTO
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

    public function __construct($observacionEquipo)
    {
        $this->observacion_equipo_id = $observacionEquipo->observacion_equipo_id;
        $this->equipo_id = $observacionEquipo->equipo_id;
        $this->fecha = $observacionEquipo->fecha;
        $this->asunto = $observacionEquipo->asunto;
        $this->actividad = $observacionEquipo->actividad;
        $this->estado = $observacionEquipo->estado;
        $this->responsable =$observacionEquipo->responsable;
        $this->firma_responsable = $observacionEquipo->firma_responsable;
        $this->proxima_actividad = $observacionEquipo->proxima_actividad;
        $this->created_at = $observacionEquipo->created_at;
        $this->updated_at = $observacionEquipo->updated_at;
    }
}
