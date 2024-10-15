<?php

namespace App\Repositories\Repositories;
use App\Models\Inventory\ItemBasico;
use App\Models\SerialCodes;
use App\Repositories\Interfaces\InterfacesSerialCodesRepository;
use DB;
use Exception;

class SerialCodeRepository implements InterfacesSerialCodesRepository
{

    public function codeExistByCode(string $code): bool
    {
        try {
            // Busca en la tabla serial_codes si existe el código proporcionado
            return SerialCodes::where('codigo', $code)->exists();
        } catch (Exception $th) {
            // Captura cualquier excepción y lanza una nueva con un mensaje personalizado
            throw new Exception("Error al comprobar existencia del serial: {$th->getMessage()}", 1);
        }
    }


  
}
