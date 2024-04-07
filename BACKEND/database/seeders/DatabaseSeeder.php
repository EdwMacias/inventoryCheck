<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\Status;
use App\Models\TypeDocument;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

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
            ['name'=> 'ACTIVO'],
            ['name'=> 'INACTIVO'],
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

        User::create([
            'name' => 'administrador',
            'email' => 'administrador@empresa.com',
            'last_name' => 'Usuario',
            'password' => password_hash("123@Cuatro#", PASSWORD_DEFAULT),
            'role_id' => 1,
            'document_type_id' => 1,
            'statu_id'=> 1,
        ]);
    }
}
