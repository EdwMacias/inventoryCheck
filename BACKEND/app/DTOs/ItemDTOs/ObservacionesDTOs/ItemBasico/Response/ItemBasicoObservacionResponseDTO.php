<?php

namespace App\DTOs\ItemDTOs\ObservacionesDTOs\ItemBasico\Response;
use App\Models\Inventory\Observaciones\ItemBasicoObservacion;

class ItemBasicoObservacionResponseDTO
{
    public $observacionItemBasicoId;
    public $itemBasicoId;
    public $fecha;
    public $descripcion;
    public $createdAt;
    public $updatedAt;
    public $imagenes = [];

    public function __construct(ItemBasicoObservacion $itemBasicoObservacion)
    {
        $this->observacionItemBasicoId = $itemBasicoObservacion->observacion_item_basico_id;
        $this->itemBasicoId = $itemBasicoObservacion->item_basico_id;
        $this->fecha = $itemBasicoObservacion->fecha;
        $this->descripcion = $itemBasicoObservacion->descripcion;
        $this->createdAt = $itemBasicoObservacion->created_at;
        $this->updatedAt = $itemBasicoObservacion->updated_at;
        // $this->imagenes = $itemBasicoObservacion->oficina->observaciones->resources ?? [];
    }
}
