<?php

namespace Database\Seeders;

use App\Models\Inventory\TypesObservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoObservacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $tiposObservaciones = [
            ['name' => 'CORRECTO'],
            ['name' => 'ADVERTENCIA'],
            ['name' => 'DAÑO'],
            ['name' => 'OTRO'],
        ];

        TypesObservation::upsert(
            $tiposObservaciones,
            ['name'],
            ['name']
        );
    }
}
