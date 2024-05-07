<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Inventory\TypesObservation;
use App\Models\Status\Status;
use App\Models\Users\Gender;
use App\Models\Users\Role;
use App\Models\Users\TypeDocument;
use App\Models\User;
use App\Models\Users\UserRole;
use App\Utils\Utilidades;
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

        User::firstOrCreate([
            'name' => 'Edwar David',
            'last_name' => 'Macias Lopez',
            'email' => 'edwmacias17@gmail.com',
            'password' => Utilidades::EncriptarPassword(env('PASSWORD_USERS_DEFAULT')),
            "gender_id" => 1,
            "address" => "Av 9 #21 Norte-2 a 21 Norte-160",
            "number_telephone" => "+573108026110",
            'document_type_id' => 1,
            "number_document" => "10202020223",
            'statu_id' => 1,
        ]);

        UserRole::firstOrCreate([
            'role_id' => 1,
            'user_id' => 1,
        ]);
    }
}
