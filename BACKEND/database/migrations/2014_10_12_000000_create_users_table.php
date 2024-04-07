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

        Schema::create('status',function (Blueprint $table){
           $table->increments('statu_id');
           $table->string('name',50);
           $table->timestamps(); 
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');

            $table->string('name', 100);
            $table->string('last_name', 100);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->integer('role_id')->unsigned();
            $table->integer('document_type_id')->unsigned();
            $table->boolean('email_verified_at')->default(false);
            $table->integer('statu_id')->unsigned()->default(1);

            $table->timestamps();


            $table->foreign('role_id')->references("role_id")->on("roles");
            $table->foreign('document_type_id')->references("document_type_id")->on("types_documents");
            $table->foreign('statu_id')->references("statu_id")->on("status");

        });


    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('types_documents');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('status');
    }
};
