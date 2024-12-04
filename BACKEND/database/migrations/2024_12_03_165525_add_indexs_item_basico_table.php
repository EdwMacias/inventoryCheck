<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::table('item_basico', function (Blueprint $table) {
            //
            $table->unique(['serie_lote']);
            $table->index(['name', 'serie_lote']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('item_basico', function (Blueprint $table) {
            //
            $table->dropIndex(['name', 'serie_lote']);
            $table->dropUnique(['serie_lote']);
        });
    }
};
