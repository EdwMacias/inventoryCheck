<?php

namespace App\Repositories\Repositories;
use App\Models\Pqrs\Pqrs;
use App\Repositories\Interfaces\InterfacePqrsRepository;

class PqrsRepository implements InterfacePqrsRepository
{
    public function create(array $datos): Pqrs
    {
        return Pqrs::create($datos);
    }

    public function update($prqsId, array $datos): bool
    {
        return Pqrs::find($prqsId)->update($datos);
    }
 
    public function get()
    {
        return Pqrs::all();
    }
}
