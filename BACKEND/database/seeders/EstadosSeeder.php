<?php

namespace Database\Seeders;

use App\Models\Status\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $estados = [
            ['name' => 'ACTIVO'],
            ['name' => 'INACTIVO'],
        ];


        Status::upsert(
            $estados,
            ['name'], // Columnas para buscar coincidencias
            ['name']  // Columnas a actualizar (en este caso, es la misma columna)
        );


    }
}
