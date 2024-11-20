<?php

namespace Database\Seeders;

use App\Models\SerialCodes;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SerialCodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        SerialCodes::upsert(
            [
                ['nombre' => 'SST', 'codigo' => 'SGSS', 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'SECRETARIA', 'codigo' => 'SECR', 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'RECEPCION', 'codigo' => 'RECE', 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'ARCHIVO', 'codigo' => 'ARCH', 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'GERENCIA', 'codigo' => 'GERE', 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'PORTERIA', 'codigo' => 'PORT', 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'CONTRATISTA', 'codigo' => 'CONT', 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'CAFETERIA', 'codigo' => 'CAFT', 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'CONTABILIDAD', 'codigo' => 'ACCO', 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'PISTA', 'codigo' => 'PIST', 'created_at' => now(), 'updated_at' => now()],
            ],
            ['codigo'], // Unique key to check for existing records
            ['nombre', 'updated_at'] // Fields to update if record exists
        );
    }
}
