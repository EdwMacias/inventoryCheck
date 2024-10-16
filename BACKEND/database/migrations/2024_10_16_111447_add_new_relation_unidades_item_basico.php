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
        Schema::table('item_basico', function (Blueprint $table) {
            $table->unsignedBigInteger('unidad_id')->nullable()->change(); // Permitir nulos
    
            $table->foreign('unidad_id', 'funidad_basico')
                ->references('unidad_id')->on('unidades')
                ->onDelete('set null'); // Configurar la eliminación en cascada para establecer el valor en null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('item_basico', function (Blueprint $table) {
            $table->dropForeign('funidad_basico');
        });
    }
};
