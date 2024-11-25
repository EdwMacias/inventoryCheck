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
        Schema::create('persona_juridica', function (Blueprint $table) {
            $table->id();
            $table->string("razon_social");
            $table->string("nit");
            $table->string("tipo_entidad")->nullable();
            $table->date("registro_camara_comercio")->nullable();
            $table->string("numero_registro_camara_comercio")->unique()->nullable();
            $table->string("pais")->nullable();
            $table->string("representante_legal")->nullable();
            $table->string("telefono");
            $table->string("email")->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persona_juridica');
    }
};
