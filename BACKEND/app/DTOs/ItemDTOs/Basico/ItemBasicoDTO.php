<?php

namespace App\DTOs\ItemDTOs\Basico;
use App\DTOs\Unidades\UnidadDTO;
use App\Models\Inventory\ItemBasico;
use Illuminate\Support\Facades\Storage;

class ItemBasicoDTO
{
    public $itemBasicoId;
    public $itemId;
    public $nombre;
    public $serial;
    public $valor;
    public $unidad;
    public $cantidad;
    public $imagen;
    public $imagenBase64;
    public $createdAt;
    public $updatedAt;

    public function __construct(ItemBasico $itemBasico)
    {
        $this->itemBasicoId = $itemBasico->item_basico_id ?? null;
        $this->itemId = $itemBasico->item_id ?? null;
        $this->nombre = $itemBasico->name ?? null;
        $this->serial = $itemBasico->serie_lote ?? null;
        $this->valor = $itemBasico->valor_adquisicion ?? null;
        $this->cantidad = $itemBasico->cantidad ?? null;
        $this->unidad = $itemBasico->unidades ? new UnidadDTO($itemBasico->unidades ?? null) : null;
        $this->imagen = (!empty($itemBasico->resource) && isset($itemBasico->resource[0])) ? url($itemBasico->resource[0]->resource) : null;
        // $this->imagenBase64 = (!empty($itemBasico->resource) && isset($itemBasico->resource[0])) ? base64_encode(file_get_contents(url($itemBasico->resource[0]->resource))) : null;
        $this->imagenBase64 = (!empty($itemBasico->resource) && isset($itemBasico->resource[0]))
        ? $this->obtenerImagenBase64($itemBasico->resource[0]->resource)
        : null;

        $this->createdAt = $itemBasico->created_at ?? null;
        $this->updatedAt = $itemBasico->updated_at ?? null;
    }

    private function obtenerImagenBase64($resource)
    {
        if (empty($resource)) {
            return null;
        }

        $filePath = str_replace('storage/', 'public/', $resource);

        if (Storage::exists($filePath)) {
            $mimeType = Storage::mimeType($filePath);
            $base64Data = base64_encode(Storage::get($filePath));
            return "data:{$mimeType};base64,{$base64Data}";
        }

        return null;
    }
   

}
