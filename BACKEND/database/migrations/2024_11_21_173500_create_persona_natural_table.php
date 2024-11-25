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
        Schema::create('persona_natural', function (Blueprint $table) {
            $table->id();
            $table->string("primer_nombre");
            $table->string("segundo_nombre")->nullable();
            $table->string("primer_apellido");
            $table->string("segundo_apellido")->nullable();
            $table->string("document_type_id");
            $table->string("numero_identificacion")->unique();
            $table->string('dv')->nullable();
            $table->string("telefono");
            $table->string("correo")->unique()->nullable();
            $table->string("direccion");
            $table->string("departamento");
            $table->string("ciudad");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persona_natural');
    }
};
