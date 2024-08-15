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
        Schema::create('observaciones_equipos', function (Blueprint $table) {
            $table->id('observacion_equipo_id');
            $table->string('equipo_id','40');
            $table->date('fecha');
            $table->string('asunto');
            $table->string('actividad');
            $table->enum('estado',['c','s','nc']);
            $table->string('responsable');
            $table->string('firma_responsable');
            $table->date('proxima_actividad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observaciones_equipos');
    }
};
