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
        Schema::create('equipo_componente', function (Blueprint $table) {
            $table->id('equipo_compt_id');
            $table->string('item_id', 40);
            $table->string('serial')->nullable();
            $table->string('cantidad');
            $table->string('cuidados')->nullable();
            $table->string('modelo')->nullable();
            $table->string('marca')->nullable();
            $table->string('nombre');
            $table->string('unidad')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipo_componente');
    }
};
