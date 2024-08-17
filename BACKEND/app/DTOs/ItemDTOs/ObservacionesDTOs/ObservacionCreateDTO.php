<?php

namespace App\DTOs\ItemDTOs\ObservacionesDTOs;
/**
 * Objeto de Transferencia de Datos (DTO) para crear una nueva observación.
 * 
 * La clase `ObservacionCreateDTO` se utiliza para encapsular los datos 
 * necesarios para crear una nueva observación. Incluye los identificadores 
 * necesarios para el ítem, el usuario y el tipo de observación.
 */
class ObservacionCreateDTO
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
     * Constructor de ObservacionCreateDTO.
     * 
     * Inicializa una nueva instancia de la clase `ObservacionCreateDTO` y 
     * genera un identificador único para `item_observation_id`.
     */
    public function __construct()
    {
        $this->item_observation_id = uuid_create();
    }

    public function toArray()
    {
        return [
            "item_observation_id" => $this->item_observation_id,
            "user_id" => $this->user_id,
            "item_id" => $this->item_id,
            "types_observation_id" => $this->types_observation_id
        ];
    }
}
