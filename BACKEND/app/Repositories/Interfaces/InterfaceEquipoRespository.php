<?php

namespace App\Repositories\Interfaces;

interface InterfaceEquipoRespository
{
    public function create(array $equipo);
    public function update(string $equipo_id,array $equipo);
    public function delete(string $equipo_id);
    
}
