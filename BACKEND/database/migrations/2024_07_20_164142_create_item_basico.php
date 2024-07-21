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
        Schema::create('item_basico', function (Blueprint $table) {
            $table->id('item_basico_id')->autoIncrement();

            $table->string('item_id', 40);
            $table->index('item_id', strtolower('IItemBas_Item'));

            $table->string('name');
            $table->string('serie_lote');
            $table->string('valor_adquisicion');

            $table->foreign('item_id', strtolower('FItemBas_Item'))->references('item_id')->on('items')
                ->onDelete('cascade')->onUpdate("cascade");

            $table->timestamps();
        });
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_basico');
        DB::statement("DROP VIEW IF EXISTS audiovisual_items");
    }
};
