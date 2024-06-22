<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');

            $table->string('name', 100);
            $table->string('last_name', 100);
            $table->string('email', 100)->unique(strtolower('UUsers_Email'));
            $table->string('address', 100);
            $table->string('number_telephone', 25);
            $table->string('number_document', 25);
            $table->integer('gender_id')->unsigned();
            $table->string('password');

            $table->integer('document_type_id')->unsigned();
            $table->boolean('email_verified_at')->default(false);
            $table->integer('statu_id')->unsigned()->default(1);

            $table->timestamps();

            $table->index('email', strtolower('IUsers_Email'));
            $table->index('document_type_id', strtolower('IUsers_DocType'));
            $table->index('number_document', strtolower('IUsers_NumDoc'));
            $table->index('gender_id', strtolower('IUsers_Gender'));
            $table->index('statu_id', strtolower('IUser_Statu'));

            $table->foreign('document_type_id', strtolower('FUsers_DocType'))
                ->references("document_type_id")->on("types_documents")
                ->onDelete("restrict");

            $table->foreign('statu_id', strtolower('FUsers_Statu'))
                ->references("statu_id")->on("status")->onDelete("restrict");

            $table->foreign('gender_id', strtolower('FUsers_Gender'))
                ->references("gender_id")->on("genders")->onDelete("restrict");

        });

        Schema::create('user_roles', function (Blueprint $table) {
            $table->increments('user_role_id');
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->timestamps();

            $table->index('user_id', strtolower('IUsRol_User'));
            $table->index('role_id', strtolower('IUsRol_Role'));

            $table->foreign('role_id', strtolower('FUsRol_Role'))
                ->references('role_id')->on('roles')->onDelete('restrict');

            $table->foreign('user_id', strtolower('FUsRol_User'))
                ->references('user_id')->on('users')->onDelete('restrict');
        });


    }

    public function down(): void
    {
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('users');
    }
};
