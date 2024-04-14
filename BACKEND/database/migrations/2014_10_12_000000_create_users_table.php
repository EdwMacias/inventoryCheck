<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

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

        Schema::create('status', function (Blueprint $table) {
            $table->increments('statu_id');
            $table->string('name', 50);
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('category_id');
            $table->string('name', 50);
            $table->timestamps();
        });

        Schema::create('genders', function (Blueprint $table) {
            $table->increments('gender_id');
            $table->string('name', 50);
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');

            $table->string('name', 100);
            $table->string('last_name', 100);
            $table->string('email', 100)->unique();
            $table->string('address', 100);
            $table->string('number_telephone', 25);
            $table->string('number_document', 25);
            $table->integer('gender_id')->unsigned();
            $table->string('password');

            $table->integer('document_type_id')->unsigned();
            $table->boolean('email_verified_at')->default(false);
            $table->integer('statu_id')->unsigned()->default(1);

            $table->timestamps();

            $table->index('email'); 
            $table->index('document_type_id'); 
            $table->index('number_document'); 
            $table->index('gender_id'); 

            $table->foreign('document_type_id')->references("document_type_id")->on("types_documents")->onDelete("restrict");
            $table->foreign('statu_id')->references("statu_id")->on("status")->onDelete("restrict");
            $table->foreign('gender_id')->references("gender_id")->on("genders")->onDelete("restrict");

        });

        Schema::create('items', function (Blueprint $table) {
            $table->increments('item_id');
            $table->string('name', 50);
            $table->string('serial_number', 100)->unique();
            $table->text('description');
            $table->string('imagen', 200);
            $table->integer('category_id')->unsigned();
            $table->integer('statu_id')->unsigned()->default(1);
            $table->timestamps();

            $table->index('category_id');

            $table->foreign('statu_id')->references("statu_id")->on("status")->onDelete("restrict");
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('restrict');
        });

        Schema::create('item_observations', function (Blueprint $table) {
            $table->increments('item_observation_id');
            $table->text('observation');
            $table->integer('item_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->index('user_id');
            $table->index('item_id');

            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('restrict');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('restrict');
        });


        Schema::create('user_roles', function (Blueprint $table) {
            $table->increments('user_role_id');
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->timestamps();

            $table->index('user_id');
            $table->index('role_id');

            $table->foreign('role_id')->references('role_id')->on('roles')->onDelete('restrict');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('types_documents');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('genders');
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('item_observations');
        Schema::dropIfExists('items');
        Schema::dropIfExists('status');
        Schema::dropIfExists('categories');
    }
};
