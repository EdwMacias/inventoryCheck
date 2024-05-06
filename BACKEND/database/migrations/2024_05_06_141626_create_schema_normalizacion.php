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
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('role_id');
            $table->string('name', 50);
            $table->timestamps();
        });

        Schema::create('types_documents', function (Blueprint $table) {
            $table->increments('document_type_id');
            $table->string('name', 50);
            $table->timestamps();
        });

        Schema::create('types_observation', function (Blueprint $table) {
            $table->increments('types_observation_id');
            $table->string('name', 50);
            $table->timestamps();
        });

        Schema::create('status', function (Blueprint $table) {
            $table->increments('statu_id');
            $table->string('name', 50);
            $table->timestamps();
        });

        Schema::create('genders', function (Blueprint $table) {
            $table->increments('gender_id');
            $table->string('name', 50);
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('category_id');
            $table->string('name', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('types_documents');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('status');
        Schema::dropIfExists('genders');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('types_observation');
    }
};
