<?php

namespace Database\Seeders;

use App\Models\Terceros\TipoPersona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoPersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipoPersonas = [
            ['codigo' => 'NAT', 'nombre' => 'NATURAL'],
            ['codigo' => 'JURD', 'nombre' => 'JURIDICA']
        ];

        TipoPersona::upsert(
            $tipoPersonas,
            ['codigo', 'nombre'],
            ['codigo', 'nombre']
        );

    }
}
