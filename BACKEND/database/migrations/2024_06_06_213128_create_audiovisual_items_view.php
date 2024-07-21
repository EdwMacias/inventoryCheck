<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE OR REPLACE VIEW audiovisual_items AS SELECT equipos.name, 
        items.item_id, audiovisual_resource.resource, equipos.serie_lote, items.category_id,
        equipos.created_at, equipos.updated_at FROM items 
        INNER JOIN equipos ON equipos.item_id = items.item_id 
        INNER JOIN audiovisual_resource ON audiovisual_resource.item_id = items.item_id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS audiovisual_items");
    }
};
