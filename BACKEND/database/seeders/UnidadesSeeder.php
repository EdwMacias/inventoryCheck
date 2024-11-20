<?php

namespace Database\Seeders;

use App\Models\Unidades;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $unidades = collect([
            ['nombre' => 'Metros', 'codigo' => 'MTR', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Galón', 'codigo' => 'GAL', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Pulgadas', 'codigo' => 'IN', 'created_at' => now(), 'updated_at' => now()], // IN para pulgadas (inches)
            ['nombre' => 'Unidades', 'codigo' => 'UNI', 'created_at' => now(), 'updated_at' => now()],
        ]);

        Unidades::upsert(
            $unidades->toArray(), // Data to insert or update
            ['codigo'], // Unique key to check for duplicates
            ['nombre','updated_at'] // Fields to update if a duplicate is found
        );

    }
}
