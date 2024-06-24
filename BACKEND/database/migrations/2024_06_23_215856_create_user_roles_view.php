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
            CREATE OR REPLACE VIEW user_roles_view AS SELECT ur.user_role_id, r.name as role_name, 
            UPPER(CONCAT(u.name,' ',u.last_name)) AS user_name, ur.created_at, ur.updated_at FROM user_roles ur 
            INNER JOIN users u ON u.user_id = ur.user_id 
            INNER JOIN roles r ON r.role_id = ur.role_id;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS user_roles_view");
    }
};
