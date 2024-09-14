<?php

namespace App\DTOs\ItemDTOs\ObservacionesDTOs\ItemBasico\Request;
use App\Utils\Utilidades;

class ItemBasicoObservacionCreateDTO
{
    public $observacionItemBasicoId;
    public $itemBasicoId;
    public $fecha;
    public $descripcion;


    public function __construct(ItemBasicoObservacionRequestDTO $itemBasicoRequestDTO)
    {
        $this->observacionItemBasicoId = uuid_create();
        $this->itemBasicoId = $itemBasicoRequestDTO->itemBasicoId ?? null;
        $this->descripcion = $itemBasicoRequestDTO->descripcion ?? null;
        $this->fecha = Utilidades::normalizeFecha($itemBasicoRequestDTO->fecha) ?? null;
    }

    public function toArray()
    {
        return [
            "observacion_item_basico_id" => $this->observacionItemBasicoId,
            "item_basico_id" => $this->itemBasicoId,
            "fecha" => $this->fecha,
            "descripcion" => $this->descripcion,
        ];
    }

}
