<?php

namespace App\DTOs\ItemDTOs\ObservacionesDTOs\ItemBasico\Request;
use App\Http\Requests\Items\Observation\Item\Basico\ObservacionItemBasicoRequest;

class ItemBasicoObservacionRequestDTO
{
    public string|null $itemId;
    public string|null $fecha;
    public string|null $descripcion;
    public string|null $userId;
    public string|null $tipoObservacionId;
    /**
     * @var null|array<\Illuminate\Http\UploadedFile>
     */
    public $imagenes = [];

    public function __construct(ObservacionItemBasicoRequest $observacionItemBasicoRequest)
    {
        $this->itemId = $observacionItemBasicoRequest->itemId ?? null;
        $this->fecha = $observacionItemBasicoRequest->fecha ?? null;
        $this->descripcion = $observacionItemBasicoRequest->observacion ?? null;
        $this->userId = $observacionItemBasicoRequest->userId ?? null;
        $this->imagenes = $observacionItemBasicoRequest->resources ?? [];
        $this->tipoObservacionId = $observacionItemBasicoRequest->tipoObservacionId ?? [];
    }
}
