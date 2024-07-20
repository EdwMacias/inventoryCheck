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
            $table->string('item_basico_id', 40)->primary();

            $table->string('item_id');
            $table->index('item_id', strtolower('IItemBas_Item'));

            $table->string('name');
            $table->string('serie_lote');
            $table->string('valor_adquisicion');

            $table->foreign('item_id', strtolower('FItemBas_Item'))->references('item_id')->on('items')
            ->onDelete('cascade')->onUpdate("cascade");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_basico');
    }
};
