<?php

namespace App\Services\Services\Terceros\PersonaJuridica;

use App\DTOs\Datatable\DatatableDTO;
use App\DTOs\Datatable\RequestDatatableDTO;
use App\DTOs\ResponsesDTO\ResponseDTO;
use App\DTOs\Terceros\Tercero\PersonaJuridica\PersonaJuridicaCreateDTO;
use App\DTOs\Terceros\Tercero\PersonaJuridica\PersonaJuridicaDTO;
use App\DTOs\Terceros\Tercero\PersonaJuridica\PersonaJuridicaTableDTO;
use App\Models\Terceros\PersonaJuridica\PersonaJuridica;
use App\Repositories\Interfaces\Terceros\PersonaJuridica\IPersonaJuridicaRepository;
use App\Services\Interfaces\Terceros\PersonaJuridica\IPersonaJuridicaService;
use Illuminate\Contracts\Database\Query\Builder;
use Symfony\Component\HttpFoundation\Response;

class PersonaJuridicaService implements IPersonaJuridicaService
{

    protected IPersonaJuridicaRepository $personaJuridicaRepository;

    public function __construct(IPersonaJuridicaRepository $iPersonaJuridicaRepository)
    {
        $this->personaJuridicaRepository = $iPersonaJuridicaRepository;
    }

    /**
     * @inheritDoc
     */
    public function create(PersonaJuridicaCreateDTO $personaJuridicaCreateDTO)
    {
        // Verifica si ya existe una Persona Jurídica con el email dado
        if ($this->personaJuridicaRepository->existByEmail($personaJuridicaCreateDTO->email)) {
            return new ResponseDTO(
                'Email ya se encuentra registrado',
                $personaJuridicaCreateDTO,
                Response::HTTP_CONFLICT
            );
        }

        // Verifica si ya existe una Persona Jurídica con el NIT dado
        if ($this->personaJuridicaRepository->existByNit($personaJuridicaCreateDTO->nit)) {
            return new ResponseDTO(
                'NIT ya se encuentra registrado',
                $personaJuridicaCreateDTO,
                Response::HTTP_CONFLICT
            );
        }

        // Crea la Persona Jurídica
        $personaJuridica = $this->personaJuridicaRepository->create($personaJuridicaCreateDTO->toArray());

        // Convierte el registro creado en un DTO
        $personaJuridicaDTO = new PersonaJuridicaDTO($personaJuridica);

        // Devuelve una respuesta indicando que la creación fue exitosa
        return new ResponseDTO(
            'Persona Juridica Creada Satisfactoriamente',
            $personaJuridicaDTO,
            Response::HTTP_CREATED
        );
    }

    public function getTercerosTable(RequestDatatableDTO $requestDatatableDTO): DatatableDTO
    {
        try {
            $datatableDTO = new DatatableDTO();

            // $personaNatural = new PersonaNatural();

            $personaNaturalQuery = PersonaJuridica::on();

            $datatableDTO->recordsTotal = $personaNaturalQuery->count();
            $datatableDTO->draw = $requestDatatableDTO->draw;
            $columns = [
                'id',
                'razon_social',
                'nit',
                'telefono',
                'email',
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
                    return new PersonaJuridicaTableDTO($personaNaturales);
                });

            return $datatableDTO;
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            throw new \Exception("Error en la creacion de la tabla de tecero juridico : {$th->getMessage()}", 500);

        }

    }

    public function getDetailsTercero($email)
    {
        $personaJuridica = $this->personaJuridicaRepository->getTerceroByEmail($email);

        $personaJuridicaDTO = new PersonaJuridicaDTO($personaJuridica);

        return new ResponseDTO('Detalles de la persona Juridica', $personaJuridicaDTO);
    }
}
