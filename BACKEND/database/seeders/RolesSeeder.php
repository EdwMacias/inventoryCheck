<?php

namespace Database\Seeders;

use App\Models\Users\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $roles = [
            ['name' => 'SUPERADMINISTRADOR'],
            ['name' => 'ADMINISTRADOR'],
            ['name' => 'USUARIO'],
        ];

        Role::upsert($roles, ['name'], ['name']);

    }
}