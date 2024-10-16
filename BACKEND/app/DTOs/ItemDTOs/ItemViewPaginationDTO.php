<?php

namespace App\DTOs\ItemDTOs;

use App\DTOs\ResourceDTOs\ResourcesResponseDTO;

class ItemViewPaginationDTO
{
    public string $item_id;
    public int $id;
    public string $name;
    public string $serial;
    public string $category_id;
    public $cantidad;
    public $unidad;
    public ?string $resource; // Puede ser null si no hay recurso
    /**
     * @var array<ResourcesResponseDTO>
     */
    public array $resources = []; // Inicializado por defecto para evitar problemas
    public string $created_at;
    public string $updated_at;

    /**
     * Constructor principal que toma un modelo y mapea las propiedades.
     * @param $item El modelo del cual se extraen los datos
     */
    public function __construct($item)
    {
        $this->item_id = $item->item_id;
        $this->category_id = $item->category_id;
        $this->created_at = $item->created_at;
        $this->updated_at = $item->updated_at;

        // Si el item tiene un equipo asociado
        if ($item->equipo) {
            $this->mapEquipo($item->equipo);
        }
        // Si el item tiene un item básico asociado
        else if ($item->itemBasico) {
            $this->mapItemBasico($item->itemBasico);
        }
        // Si no tiene ni equipo ni item básico, asignamos valores por defecto
        else {
            $this->name = 'No existe';
            $this->id = 0;
            $this->serial = '';
            $this->resource = null;
        }
    }

    /**
     * Mapea los datos del equipo al DTO.
     * @param $equipo El equipo asociado al item
     */
    private function mapEquipo($equipo): void
    {
        $this->name = $equipo->name;
        $this->id = $equipo->equipo_id;
        $this->serial = $equipo->serie_lote;
        $this->cantidad = 1;
        $this->unidad = 'UNI';
        $this->resource = (!empty($equipo->resource) && isset($equipo->resource[0])) ? url($equipo->resource[0]->resource) : null;
        // Convertimos la colección a array antes de pasarla
        $this->mapResources($equipo->resource);
    }

    /**
     * Mapea los datos del item básico al DTO.
     * @param $itemBasico El item básico asociado al item
     */
    private function mapItemBasico($itemBasico): void
    {
        $this->name = $itemBasico->name;
        $this->id = $itemBasico->item_basico_id;
        $this->serial = $itemBasico->serie_lote;
        $this->cantidad = intval($itemBasico->cantidad ?? '1');
        $this->unidad = $itemBasico->uniades->codigo ?? 'UNI';
        $this->resource = (!empty($itemBasico->resource) && isset($itemBasico->resource[0])) ? url($itemBasico->resource[0]->resource) : null;
        // Convertimos la colección a array antes de pasarla
        $this->mapResources($itemBasico->resource);
    }

    /**
     * Mapea los recursos al DTO.
     * @param array $resources Un array de recursos asociados
     */
    private function mapResources($resources): void
    {
        foreach ($resources as $resource) {
            $this->resources[] = new ResourcesResponseDTO($resource);
        }
    }

    /**
     * Método estático para crear un DTO a partir de un modelo.
     * @param $item El modelo del cual se extraen los datos
     * @return static Una nueva instancia de este DTO
     */
    public static function fromModel($item): self
    {
        return new self($item);
    }
}
