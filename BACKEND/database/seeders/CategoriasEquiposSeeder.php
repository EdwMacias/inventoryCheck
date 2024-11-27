<?php

namespace Database\Seeders;

use App\Models\Inventory\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriasEquiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'EQUIPO_PISTA'],
            ['name' => 'ADMINISTRATIVO'],
            ['name' => 'MANTENIMIENTO']
        ];


        Category::upsert($categories, ['name'], ['name']);
        //
    }
}
