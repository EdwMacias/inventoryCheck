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
        //
        Schema::table('equipos', function (Blueprint $table) {
            // $table->string('serie')
            $table->string('serie_lote')->nullable()->change();
            $table->index(['name', 'serie_lote']);
            $table->unique(['serie_lote']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //.
        Schema::table('equipos', function (Blueprint $table) {
            $table->string('serie_lote')->nullable(false)->change();
            $table->dropIndex(['name', 'serie_lote']);
            $table->dropUnique(['serie_lote']);
        });

    }
};
