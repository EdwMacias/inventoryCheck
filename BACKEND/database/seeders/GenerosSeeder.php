<?php

namespace Database\Seeders;

use App\Models\Users\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenerosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genders =collect([
            ["name" => "HOMBRE"],
            ["name" => "MUJER"],
            ["name" => "NO ESPECIFICA"]
        ]);

        // Inserta o actualiza cada género basado en la columna 'name'
        Gender::upsert(
            $genders->toArray(), // Datos a insertar o actualizar
            ['name'], // Columnas para buscar coincidencias
            ['name']  // Columnas a actualizar (en este caso, es la misma columna)
        );

        //
    }
}
