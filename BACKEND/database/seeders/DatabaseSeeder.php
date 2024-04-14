<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Status\Status;
use App\Models\Users\Gender;
use App\Models\Users\Role;
use App\Models\Users\TypeDocument;
use App\Models\Users\User;
use App\Models\Users\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $genders = [
            ["name" => "HOMBRE"],
            ["name" => "MUJER"]
        ];

        $roles = [
            ['name' => 'SUPERADMINISTRADOR'],
            ['name' => 'ADMINISTRADO'],
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

        User::firstOrCreate([
            'name' => 'Edwar David',
            'last_name' => 'Macias Lopez',
            'email' => 'edwmacias17@gmail.com',
            'password' => password_hash("123@Cuatro#", PASSWORD_DEFAULT),
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
