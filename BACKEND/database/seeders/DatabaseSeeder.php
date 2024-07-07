<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Inventory\Category;
use App\Models\Inventory\TypesObservation;
use App\Models\Status\Status;
use App\Models\Users\Gender;
use App\Models\Users\Role;
use App\Models\Users\TypeDocument;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $genders = [
            ["name" => "HOMBRE"],
            ["name" => "MUJER"],
            ["name" => "NO ESPECIFICA"]
        ];

        $roles = [
            ['name' => 'SUPERADMINISTRADOR'],
            ['name' => 'ADMINISTRADOR'],
            ['name' => 'USUARIO'],
        ];
        $documentos = [
            ['name' => 'C.C'],
            ['name' => 'T.I'],
            ['name' => 'NIT'],
        ];

        $estados = [
            ['name' => 'ACTIVO'],
            ['name' => 'INACTIVO'],
        ];

        $tiposObservaciones = [
            ['name' => 'CORRECTO'],
            ['name' => 'ADVERTENCIA'],
            ['name' => 'DAÑO'],
            ['name' => 'OTRO'],
        ];

        $categories = [
            ['name' => 'EQUIPO_PISTA'],
            ['name' => 'ADMINISTRATIVO'],
            ['name' => 'MANTENIMIENTO']
        ];

        foreach ($documentos as $documento) {
            TypeDocument::firstOrCreate($documento);
        }

        foreach ($roles as $rol) {
            Role::firstOrCreate($rol);
        }

        foreach ($estados as $estado) {
            Status::firstOrCreate($estado);
        }

        foreach ($genders as $gender) {
            Gender::firstOrCreate($gender);
        }

        foreach ($tiposObservaciones as $tiposObservacion) {
            TypesObservation::firstOrCreate($tiposObservacion);
        }

        foreach ($categories as $category) {
            Category::firstOrCreate($category);
        }

    }
}
