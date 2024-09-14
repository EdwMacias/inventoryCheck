<?php

namespace App\Services\Interfaces;

use App\DTOs\ItemDTOs\ItemBasicoCreateRequestDTO;
use App\DTOs\ItemDTOs\ItemObservationDTO;
use App\DTOs\ItemDTOs\ItemObservationUpdateDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ItemBasico\Request\ItemBasicoObservacionRequestDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ItemBasico\Request\ItemBasicoRequestDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ObservacionEquipoCreateRequestDTO;
use App\DTOs\ResponsesDTO\ResponseDTO;
use Illuminate\Http\JsonResponse;

interface InterfaceItemObservationServices
{
  /**
   * Summary of createObservacionEquipo
   * @param \App\DTOs\ItemDTOs\ObservacionesDTOs\ObservacionEquipoCreateRequestDTO $equiposCreateRequestDTO
   * @return \Illuminate\Http\JsonResponse
   */
  public function createObservacionEquipo(ObservacionEquipoCreateRequestDTO $equiposCreateRequestDTO): JsonResponse;

  public function getEquipoObservaciones($itemID);

  public function createObservacionItemBasico(ItemBasicoObservacionRequestDTO $itemBasicoRequestDTO): ResponseDTO;

}
