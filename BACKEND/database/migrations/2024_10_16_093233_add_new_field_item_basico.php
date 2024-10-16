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
            //
            $table->string('cantidad', 40)->after('valor_adquisicion')->nullable();
            $table->bigInteger('unidad_id')->after('cantidad')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('item_basico', function (Blueprint $table) {
            $table->dropColumn('cantidad');
            $table->dropColumn('unidad_id');
        });
    }
};
