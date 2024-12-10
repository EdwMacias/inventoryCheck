<?php

namespace App\Services\Services\Terceros\PersonaNatural;

use App\DTOs\Datatable\DatatableDTO;
use App\DTOs\Datatable\RequestDatatableDTO;
use App\DTOs\ResponsesDTO\ResponseDTO;
use App\DTOs\Terceros\Tercero\PersonaNatural\PersonaNaturalCreateDTO;
use App\DTOs\Terceros\Tercero\PersonaNatural\PersonaNaturalDTO;
use App\DTOs\Terceros\Tercero\PersonaNatural\PersonaNaturalTableDTO;
use App\Models\Terceros\PersonaNatural\PersonaNatural;
use App\Repositories\Interfaces\Terceros\PersonaNatural\IPersonaNaturalRepository;
use App\Services\Interfaces\Terceros\PersonaNatural\IPersonaNaturalServices;
use Exception;
use Illuminate\Contracts\Database\Query\Builder;
use Symfony\Component\HttpFoundation\Response;

/**
 * Clase PersonaNaturalService
 * Maneja las operaciones relacionadas con el registro y consulta de personas naturales.
 */
class PersonaNaturalService implements IPersonaNaturalServices
{
    /**
     * Repositorio de Persona Natural
     *
     * @var IPersonaNaturalRepository
     */
    protected IPersonaNaturalRepository $personaNaturalRepository;
    /**
     * Constructor de la clase
     *
     * @param IPersonaNaturalRepository $iPersonaNaturalRepository
     */
    public function __construct(IPersonaNaturalRepository $iPersonaNaturalRepository)
    {
        $this->personaNaturalRepository = $iPersonaNaturalRepository;
    }

    public function create(PersonaNaturalCreateDTO $personaNaturalCreateDTO)
    {
        if ($this->personaNaturalRepository->existByNumberIdentification($personaNaturalCreateDTO->numeroIdentificacion)) {
            return new ResponseDTO('El número de identificacion ya fue registrado', $personaNaturalCreateDTO, Response::HTTP_CONFLICT);
        }

        if ($personaNaturalCreateDTO->correo && $this->personaNaturalRepository->existByEmail($personaNaturalCreateDTO->correo)) {
            return new ResponseDTO('El correo ya fue registrado', $personaNaturalCreateDTO, Response::HTTP_CONFLICT);
        }

        $personaNatural = $this->personaNaturalRepository->create($personaNaturalCreateDTO->toArray());
        $personaNaturalDTO = new PersonaNaturalDTO($personaNatural);

        return new ResponseDTO('Persona Natural Registrada Con Satisfactoriamente', $personaNaturalDTO, Response::HTTP_CREATED);
    }

    public function showById(string $personaNaturalId)
    {
        $personaNatural = $this->personaNaturalRepository->getById($personaNaturalId);
        $personaNaturalDTO = new PersonaNaturalDTO($personaNatural);
        return new ResponseDTO('Datos Obtenidos Exitosamente', $personaNaturalDTO, Response::HTTP_OK);
    }

    public function getTercerosTable(RequestDatatableDTO $requestDatatableDTO): DatatableDTO
    {
        try {
            $datatableDTO = new DatatableDTO();

            // $personaNatural = new PersonaNatural();

            $personaNaturalQuery = PersonaNatural::with(["documento"]);

            $datatableDTO->recordsTotal = $personaNaturalQuery->count();
            $datatableDTO->draw = $requestDatatableDTO->draw;
            $columns = [
                'id',
                'numero_identificacion',
                'dv',
                'primer_nombre',
                'segundo_nombre',
                'primer_apellido',
                'segundo_apellido',
                'telefono',
                'document_type_id',
                'correo',
                'created_at',
                'updated_at'
            ];

            if ($requestDatatableDTO->searchValue) {
                $personaNaturalQuery->where(function (Builder $query) use ($requestDatatableDTO, $columns) {
                    $searchValue = "%{$requestDatatableDTO->searchValue}%";

                    // Buscar en las columnas principales
                    foreach ($columns as $column) {
                        $query->orWhere($column, 'like', $searchValue);
                    }

                    // Buscar en la relación 'equipo'
                    $query->orWhereHas('documento', function (Builder $subQuery) use ($searchValue) {
                        $subQuery->where('name', 'like', "{$searchValue}%");
                    });
                });
            }

            $datatableDTO->recordsFiltered = $personaNaturalQuery->count();

            if ($requestDatatableDTO->order) {
                # code...
                foreach ($requestDatatableDTO->order as $order) {
                    $columnIndex = $order['column'];
                    $columnName = $columns[$columnIndex] ?? null;
                    $direction = $order['dir'];

                    if ($columnName) {
                        $personaNaturalQuery->orderBy($columnName, $direction);
                    }
                }
            }

            if ($requestDatatableDTO->length != -1) {
                $personaNaturalQuery->offset(value: $requestDatatableDTO->start)->limit($requestDatatableDTO->length);
            }

            $datatableDTO->data = $personaNaturalQuery->get($columns)
                ->transform(function ($personaNaturales) {
                    return new PersonaNaturalTableDTO($personaNaturales);
                });

            return $datatableDTO;
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            throw new Exception("Error en la creacion de la tabla de tecero natural : {$th->getMessage()}", 500);

        }

    }

    public function getDetailsTercero($email)
    {
        $personaNatural = $this->personaNaturalRepository->getTerceroById($email);

        $personaNaturalDTO = new PersonaNaturalDTO($personaNatural);

        return new ResponseDTO('Detalles de la persona natural', $personaNaturalDTO);
    }

}
