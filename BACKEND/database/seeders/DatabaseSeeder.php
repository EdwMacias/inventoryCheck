<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategoriasEquiposSeeder::class,
            EstadosSeeder::class,
            GenerosSeeder::class,
            RolesSeeder::class,
            SerialCodesSeeder::class,
            TipoObservacionesSeeder::class,
            TipoPersonaSeeder::class,
            TiposDocumentosSeeder::class,
            UnidadesSeeder::class,
        ]);
    }
}
