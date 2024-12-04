<?php

namespace App\Repositories\Repositories;

use App\Models\Inventory\Equipo;
use App\Models\Inventory\EquipoComponentes;
use App\Repositories\Interfaces\InterfaceEquipoRespository;
use DB;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class EquipoRespository implements InterfaceEquipoRespository
{

    /**
     * Summary of create
     * @param array $equipo
     * @return bool
     */
    public function create(array $equipo)
    {
        $equipoModel = Equipo::create($equipo);
        $equipoModel->serie_lote = $this->generateAutoIncrementCode('PIST', $equipoModel->equipo_id);
        return true;
        // return $equipoModel->save();
    }

    /**
     * Summary of delete
     * @param string $equipo_id
     * @return bool|mixed|null
     */
    public function delete(string $equipo_id)
    {
        return Equipo::find($equipo_id)->delete();
    }

    /**
     * Summary of update
     * @param string $equipo_id
     * @param array $equipo
     * @return bool|mixed
     */
    public function update(string $equipo_id, array $equipo)
    {
        return Equipo::find($equipo_id)->update($equipo);
    }
    /**
     * Summary of getEquipoByEquipoID
     * @param string $equipo_id
     * @return Equipo|Equipo[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getEquipoByEquipoID(string $equipo_id)
    {
        return Equipo::find($equipo_id);
    }
    /**
     * Summary of equipoExistByItemID
     * @param string $itemId
     * @return bool
     */
    public function equipoExistByItemID(string $itemId)
    {
        return Equipo::where('item_id', $itemId)->exists();
    }
    /**
     * Recupera un registro del modelo `Equipo` basado en el `item_id` proporcionado.
     *
     * Este método busca en la tabla `Equipo` un registro donde el `item_id` coincida con el `$itemId`
     * proporcionado y devuelve el primer resultado encontrado.
     * 
     * @param string $itemId El ID del ítem para buscar el equipo.
     * 
     * @return Equipo|object|\Illuminate\Database\Eloquent\Model|null El modelo `Equipo` encontrado,
     * un objeto genérico, o `null` si no se encuentra ningún registro.
     */
    public function getEquipoByItemID(string $itemId)
    {
        try {
            $equipo = Equipo::where('item_id', $itemId)->first();
            if (!$equipo) {
                throw new Exception("El equipo no ha sido encontrado por itemId", Response::HTTP_NOT_FOUND);
            }
            return $equipo;
        } catch (\Throwable $th) {
            throw new Exception(
                "Error al buscar item equipo por itemId : {$th->getMessage()} ",
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

    }

    public function equipoExistBySerialLote(string $serialLote)
    {
        return Equipo::where('serie_lote', $serialLote)->exists();
    }

    /**
     * @inheritDoc
     */
    public function createComponentesEquipo(array $datos)
    {
        $now = now(); // Obtén la fecha y hora actual
        $datos = array_map(function ($registro) use ($now) {
            if (is_array($registro)) {
                $registro['created_at'] = $now;
                $registro['updated_at'] = $now;
            }
            return $registro;
        }, $datos);
        return EquipoComponentes::insert($datos);
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
                $lastCode = Equipo::where('serie_lote', 'like', "$prefix%")
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
                Equipo::find($id)->update(['serie_lote' => $newCode]);

                // Retorna el nuevo código generado
                return $newCode;

            } catch (Exception $e) {
                // Lanza una excepción en caso de error
                throw new Exception("Error al generar el código autoincremental: {$e->getMessage()}");
            }
        });
    }
}
