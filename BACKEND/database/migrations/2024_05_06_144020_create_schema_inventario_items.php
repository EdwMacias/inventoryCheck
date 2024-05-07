<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('item_id');
            $table->string('name', 50);
            $table->string('serial_number', 100)->unique();
            $table->text('description');

            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('statu_id')->unsigned()->default(1);

            $table->timestamps();

            $table->index('category_id');

            $table->foreign('statu_id')->references("statu_id")->on("status")
            ->onDelete("restrict")->onUpdate("cascade");
            $table->foreign('category_id')->references('category_id')->on('categories')
            ->onDelete('restrict')->onUpdate("cascade");
        });

        Schema::create('item_observations', function (Blueprint $table) {
            $table->increments('item_observation_id');

            $table->text('observation');

            $table->integer('item_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('types_observation_id')->unsigned();

            $table->index('user_id');
            $table->index('item_id');

            $table->foreign('item_id')->references('item_id')->on('items')
                ->onDelete('restrict')->onUpdate("cascade");

            $table->foreign('user_id')->references('user_id')->on('users')
                ->onDelete('restrict')->onUpdate("cascade");

            $table->foreign('types_observation_id')->references('types_observation_id')
                ->on('types_observation')->onDelete('restrict')->onUpdate("cascade");

            $table->timestamps();
        });

        Schema::create('audiovisual_resource', function (Blueprint $table) {
            $table->increments('audiovisual_resource_id');

            $table->integer('item_id')->nullable()->unsigned();
            $table->integer('item_observation_id')->nullable()->unsigned();

            $table->text('resource');

            $table->timestamps();

            $table->foreign('item_observation_id')->references("item_observation_id")
                ->on("item_observations")->onDelete("restrict")->onUpdate("cascade");

            $table->foreign('item_id')->references("item_id")
                ->on("items")->onDelete("restrict")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
        Schema::dropIfExists('item_observations');
        Schema::dropIfExists('audiovisual_resource');
    }
};
