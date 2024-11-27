<?php

namespace Database\Seeders;

use App\Models\Users\TypeDocument;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiposDocumentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $documentos = [
            ['name' => 'C.C'],
            ['name' => 'C.E'],
            ['name' => 'NIT'],
            ['name' => 'PASAPORTE'],
        ];

        TypeDocument::upsert(
            $documentos,
            ['name'],
            ['name']
        );
    }
}
