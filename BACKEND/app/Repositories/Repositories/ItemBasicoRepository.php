<?php

namespace App\Repositories\Repositories;
use App\DTOs\ItemDTOs\Basico\ItemBasicoDTO;
use App\Models\Inventory\ItemBasico;
use App\Models\Inventory\Observaciones\ItemBasicoObservacion;
use App\Repositories\Interfaces\InterfaceItemBasicoRepository;
use DB;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class ItemBasicoRepository implements InterfaceItemBasicoRepository
{

    /**
     * @param array $itemBasico
     * Datos del item basico a crear
     */
    public function create(array $itemBasico, $prefix = null)
    {
        $itemBasico = ItemBasico::create($itemBasico);
        $itemBasicoDTO = new ItemBasicoDTO($itemBasico);
        $itemBasico->serie_lote = $this->generateAutoIncrementCode($prefix, $itemBasicoDTO->itemBasicoId);
        return $itemBasico;
    }
    public function getItemBasicoByItemId(string $itemId)
    {
        try {
            // Buscar el registro en la tabla ItemBasico usando item_id
            $itemBasico = ItemBasico::where('item_id', $itemId)->first();

            // Verificar si no se encontró el registro
            if (!$itemBasico) {
                throw new Exception("No se encontró el item de oficina por itemId", Response::HTTP_NOT_FOUND);
            }

            return $itemBasico; // Retornar el registro encontrado
        } catch (\Throwable $th) {
            // Manejo de errores y lanzar excepción con mensaje detallado
            throw new Exception(
                "Error al buscar item oficina por itemId: {$th->getMessage()}",
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    /**
     * Resumen de createObservacion
     *
     * Este método crea un nuevo registro en la tabla `ItemBasicoObservacion` utilizando los datos proporcionados en el arreglo `$datos`.
     *
     * @param array $datos Un arreglo asociativo que contiene los datos necesarios para crear una nueva observación.
     * 
     * @return ItemBasicoObservacion|\Illuminate\Database\Eloquent\Model 
     * Devuelve una instancia del modelo `ItemBasicoObservacion` recién creada.
     * El tipo de retorno puede ser:
     * - `\App\Models\Inventory\ItemBasicoObservacion`: La observación recién creada.
     * - `\Illuminate\Database\Eloquent\Model`: El modelo base de Eloquent que contiene el nuevo registro.
     */
    public function createObservacion(array $datos)
    {
        $itemBasico = ItemBasicoObservacion::create($datos);
        return $itemBasico;
    }

    public function itemBasicoExistBySerialLote(string $serialLote)
    {
        return ItemBasico::where('serie_lote', $serialLote)->exists();
    }


    /**
     * Genera un código autoincremental basado en un prefijo dado con bloqueo pesimista.
     * 
     * Usa el bloqueo pesimista para evitar duplicación de códigos en situaciones concurrentes.
     * 
     * @param string $prefix El prefijo para el código (por ejemplo, 'SST', 'CCT').
     * 
     * @throws \Exception Si ocurre un error en la consulta o en la generación del código.
     * 
     * @return string El nuevo código generado (por ejemplo, 'SST00002', 'CCT00003').
     */
    private function generateAutoIncrementCode(string $prefix, string $id): string
    {
        return DB::transaction(function () use ($prefix, $id) {
            try {
                // Bloquea los registros coincidentes con el prefijo dado
                $lastCode = ItemBasico::where('serie_lote', 'like', "$prefix%")
                    ->lockForUpdate()->orderBy('serie_lote', 'desc')->get('serie_lote')->first() // Bloqueo pesimista
                ;
                // $lastCode = json_encode($lastCode);
                // throw new Exception("Error al generar el código autoincremental: {$lastCode}");

                // Si no hay ningún código previo con el prefijo, iniciamos desde 1
                if (!$lastCode) {
                    $newNumber = 1;
                } else {
                    // Extrae el número del último código (ejemplo: 'SST00001' -> 00001)
                    $lastNumber = intval(substr($lastCode->serie_lote, strlen($prefix)));
                    // Incrementa el número
                    $newNumber = $lastNumber + 1;
                }

                // Formatea el nuevo número con ceros a la izquierda (ejemplo: 1 -> '00001')
                $newCode = $prefix . str_pad($newNumber, 5, '0', STR_PAD_LEFT);

                // Inserta el nuevo código en la tabla
                ItemBasico::find($id)->update(['serie_lote' => $newCode]);

                // Retorna el nuevo código generado
                return $newCode;

            } catch (Exception $e) {
                // Lanza una excepción en caso de error
                throw new Exception("Error al generar el código autoincremental: {$e->getMessage()}");
            }
        });
    }
}
