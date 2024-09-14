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

        Schema::create('observaciones_items_basicos', function (Blueprint $table) {
            $table->string('observacion_item_basico_id', 40)->primary();
            $table->unsignedBigInteger('item_basico_id'); // Creación de la columna
        
            $table->date('fecha');
            $table->text('descripcion');
        
            // Crear índice en 'item_basico_id'
            $table->index('item_basico_id', 'iBasicoIdF');
        
            // Definir clave foránea
            $table->foreign('item_basico_id')->references('item_basico_id')->on('item_basico')
                ->onDelete('cascade')->onUpdate('cascade');
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observacion_item_basico');
    }
};
