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
        Schema::create('temporary_codes', function (Blueprint $table) {
            $table->increments('temporary_code_id');
            $table->string('code', 6);
            $table->integer('user_id')->unsigned();

            $table->foreign('user_id',strtolower('FTempCode_User'))->references('user_id')->on('users')->onDelete('cascade');
            
            $table->boolean('is_used')->default(false);
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporary_codes');
    }
};
