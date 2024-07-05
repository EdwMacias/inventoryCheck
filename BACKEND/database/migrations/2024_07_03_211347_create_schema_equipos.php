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
        Schema::create('equipos', function (Blueprint $table) {
            // $table->id();
            $table->id('equipo_id')->autoIncrement();
            $table->string('item_id', 40);
            $table->index('item_id', strtolower('IEquipos_Item'));
            // datos basicos
            $table->string('name');
            $table->string('fabricante');
            $table->string('modelo');
            $table->string('marca');
            $table->string('serie_lote');
            $table->string('activo_fijo');
            $table->string('ubicacion');
            $table->string('ficha_tecnica');
            $table->string('manual');
            $table->string('garantia');
            $table->string('instruc_operacion');
            $table->string('periocidad_calibracion');
            $table->string('periocidad_verificacion');
            $table->string('proveedor');
            $table->string('contacto_proveedor');
            $table->string('telefono_proveedor');
            $table->string('email_proveedor');
            
            //CARACTERISTICAS METROLOGICAS DEL EQUIPO
            $table->string('resolucion')->nullable(); 
            $table->string('clase_exactitud')->nullable(); 
            $table->string('rango_medicion')->nullable(); 
            $table->string('intervalo_medicion')->nullable(); 
            $table->string('error_maximo_permitido')->nullable();
            
            // DATOS DE ADQUISICIÓN  DEL EQUIPO
            $table->timestamp('fecha_adquisicion');
            $table->integer('valor_adquicion')->nullable();
            $table->string('numero_factura')->nullable();

            // DATOS CALIBRACIÓN DEL EQUIPO
            $table->timestamp('fecha_calibracion_actual')->nullable();
            $table->timestamp('fecha_proxima_calibracion')->nullable();
            $table->string('maxima_incertidumbre_calibracion')->nullable();
            $table->string('proveedor_calibracion')->nullable();
            $table->string('contacto_calibracion')->nullable();
            $table->string('telefono_calibracion')->nullable();
            $table->string('email_calibracion')->nullable();

            // Control de equipos

            $table->string('frecuencia_verificacion');
            $table->string('procedimiento_verificacion');
            $table->string('frecuencia_calibracion')->nullable();

            $table->foreign('item_id', strtolower('FEquipos_Item'))->references('item_id')->on('items')
                ->onDelete('cascade')->onUpdate("cascade");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
