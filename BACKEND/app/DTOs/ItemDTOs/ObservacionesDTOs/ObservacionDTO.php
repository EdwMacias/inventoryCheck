<?php

namespace App\DTOs\ItemDTOs\ObservacionesDTOs;

/**
 * Objeto de Transferencia de Datos (DTO) para manejar una observación.
 * 
 * La clase `ObservacionDTO` encapsula los datos relacionados con una observación,
 * incluyendo los identificadores necesarios para el ítem, el usuario, y el tipo de observación,
 * así como las marcas de tiempo de creación y actualización.
 */
class ObservacionDTO
{
    /**
     * @var string El identificador único para la observación.
     */
    public $item_observation_id;

    /**
     * @var int El identificador del ítem asociado con la observación.
     */
    public $item_id;

    /**
     * @var int El identificador del usuario que realiza la observación.
     */
    public $user_id;

    /**
     * @var int El identificador del tipo de observación.
     */
    public $types_observation_id;

    /**
     * @var \Carbon\Carbon|null La fecha y hora en que se creó la observación.
     */
    public $created_at;

    /**
     * @var \Carbon\Carbon|null La fecha y hora en que se actualizó la observación por última vez.
     */
    public $updated_at;

    /**
     * Constructor de ObservacionDTO.
     * 
     * Inicializa una nueva instancia de la clase `ObservacionDTO` usando los datos de una observación existente.
     * 
     * @param \App\Models\Inventory\ItemObservation $observacion Los datos de la observación para inicializar el DTO.
     */
    public function __construct($observacion)
    {
        $this->item_observation_id = $observacion->item_observation_id;
        $this->user_id = $observacion->user_id;
        $this->item_id = $observacion->item_id;
        $this->types_observation_id = $observacion->types_observation_id;
        $this->created_at = $observacion->created_at;
        $this->updated_at = $observacion->updated_at;
    }
}
