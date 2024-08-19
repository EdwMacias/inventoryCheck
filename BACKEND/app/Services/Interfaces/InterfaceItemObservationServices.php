<?php

namespace App\Services\Interfaces;

use App\DTOs\ItemDTOs\EquiposDTOs\EquiposCreateRequestDTO;
use App\DTOs\ItemDTOs\ItemObservationDTO;
use App\DTOs\ItemDTOs\ItemObservationUpdateDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ObservacionEquipoCreateRequestDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;

interface InterfaceItemObservationServices
{
  /**
   *
   * @param ItemObservationDTO $itemObservationDTO
   * dto con los datos a crear de la observacion del item
   * @param array $resources
   */
  public function create(ItemObservationDTO $itemObservationDTO, array $resources);
  /**
   *
   * @param string $observationId
   * id de la observacion a actualizar
   * @param ItemObservationDTO $itemObservationDTO
   * dto con los parametros a actualizar
   */
  public function update(string $observationId, ItemObservationUpdateDTO $itemObservationDTO);
  /**
   *
   * @param string $observationId
   * id de la observacion a buscar
   */
  public function getObservationByObservationId(string $observationId);
  /**
   *
   * @param string $itemId
   * id del item a buscar por observaciones
   */
  public function getObservationsByItemId(string $itemId);

  /**
   * Summary of createObservacionEquipo
   * @param \App\DTOs\ItemDTOs\ObservacionesDTOs\ObservacionEquipoCreateRequestDTO $equiposCreateRequestDTO
   * @return \Illuminate\Http\JsonResponse
   */
  public function createObservacionEquipo(ObservacionEquipoCreateRequestDTO $equiposCreateRequestDTO): JsonResponse;

  public function getEquipoObservaciones($itemID);

}
