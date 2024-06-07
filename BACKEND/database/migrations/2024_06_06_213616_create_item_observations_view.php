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
        DB::statement("
            CREATE OR REPLACE VIEW item_observations_with_resource AS
            SELECT io.*, ar.resource
            FROM item_observations io
            LEFT JOIN audiovisual_resource ar ON io.item_observation_id = ar.item_observation_id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS item_observations_with_resource");
    }
};
