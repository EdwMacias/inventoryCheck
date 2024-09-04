<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("DROP VIEW audiovisual_items");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("CREATE OR REPLACE VIEW audiovisual_items AS SELECT
        equipos.name,
        items.item_id,
        audiovisual_resource.resource,
        equipos.serie_lote,
        items.category_id,
        equipos.created_at,
        equipos.updated_at
        FROM
            items
        INNER JOIN equipos ON equipos.item_id = items.item_id
        INNER JOIN audiovisual_resource ON audiovisual_resource.item_id = items.item_id
        UNION
        SELECT
            item_basico.name,
            items.item_id,
            audiovisual_resource.resource,
            item_basico.serie_lote,
            items.category_id,
            item_basico.created_at,
            item_basico.updated_at
        FROM
            items
        INNER JOIN item_basico ON items.item_id = item_basico.item_id
        INNER JOIN audiovisual_resource ON audiovisual_resource.item_id = items.item_id");
    }
};
