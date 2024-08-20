<?php

namespace App\DTOs\PqrsDTOs\Response;
/**
 * Objeto de Transferencia de Datos para la Respuesta de PQRS.
 */
class PqrsResponseDTO
{
    /**
     * @var string|null
     */
    public ?string $name;

    /**
     * @var string|null
     */
    public ?string $opcion;

    /**
     * @var string|null
     */
    public ?string $descriptionPQRS;

    /**
     * @var \DateTime|null
     */
    public ?\DateTime $created_at;

    /**
     * @var \DateTime|null
     */
    public ?\DateTime $updated_at;

    /**
     * Constructor de PqrsResponseDTO.
     *
     * @param object $pqrs El objeto PQRS que contiene los datos de la respuesta.
     */
    public function __construct(object $pqrs)
    {
        $this->name = $pqrs->nombre ?? null;
        $this->opcion = $pqrs->opcion ?? null;
        $this->descriptionPQRS = $pqrs->descripcion ?? null;
        $this->created_at = $pqrs->created_at ?? null;
        $this->updated_at = $pqrs->updated_at ?? null;
    }
}
