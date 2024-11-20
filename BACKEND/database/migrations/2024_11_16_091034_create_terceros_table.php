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
        Schema::create('terceros', function (Blueprint $table) {
            $table->id('terceroId'); // Llave primaria
            $table->integer('tipoDocumentoId')->nullable(); // Puede ser nulo si no se proporciona el tipo de documento inicialmente
            $table->string('#documento');
            $table->bigInteger('tipoPersonaId'); // Este campo debería ser obligatorio para distinguir entre tipos de terceros
            $table->string('razonSocial')->nullable(); // Nulo para personas naturales, obligatorio para empresas
            $table->string('primerNombre')->nullable(); // Nulo para empresas, obligatorio para personas
            $table->string('segundoNombre')->nullable(); // No todos tienen segundo nombre
            $table->string('primerApellido')->nullable(); // Nulo para empresas, obligatorio para personas
            $table->string('segundoApelldo')->nullable(); // No todos tienen segundo apellido
            $table->string('email')->nullable(); // Puede ser nulo si el email no es obligatorio
            $table->string('direccion')->nullable(); // Puede ser nulo si no se requiere dirección
            $table->string('ciudad')->nullable(); // Puede ser nulo si no se especifica la ciudad
            $table->string('departamento')->nullable(); // Puede ser nulo si no se especifica el departamento
            $table->string('pais')->nullable(); // Puede ser nulo si no se especifica el país
            $table->string('telefono')->nullable(); // Puede ser nulo si no es obligatorio el teléfono
            $table->string('foto')->nullable(); // La foto es opcional
            $table->timestamps(); // Agrega automáticamente created_at y updated_at, que pueden ser nulos inicialmente
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terceros');
    }
};
