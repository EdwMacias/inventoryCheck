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
        DB::statement("
        CREATE OR REPLACE VIEW audiovisual_items AS
        SELECT ar.audiovisual_resource_id, i.item_id, i.created_at
        FROM items i
        INNER JOIN audiovisual_resource ar ON i.item_id = ar.item_id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS audiovisual_items");
    }
};
