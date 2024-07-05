<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->string('item_id', 40)->primary();
            $table->integer('category_id')->unsigned();
            $table->integer('statu_id')->unsigned()->default(1);
            
            $table->timestamps();
            $table->index('category_id', strtolower('IItems_Category'));

            $table->foreign('statu_id', strtolower('FItems_Statu'))->references("statu_id")->on("status")
                ->onDelete("restrict")->onUpdate("cascade");
            $table->foreign('category_id', strtolower('FItems_Category'))->references('category_id')->on('categories')
                ->onDelete('restrict')->onUpdate("cascade");
        });

        Schema::create('item_observations', function (Blueprint $table) {
            $table->string('item_observation_id', 40)->primary();

            $table->text('observation');

            $table->string('item_id', 40);
            $table->integer('user_id')->unsigned();
            $table->integer('types_observation_id')->unsigned();

            $table->index('user_id', strtolower('IItemObs_User'));
            $table->index('item_id', strtolower('IItemObs_Item'));

            $table->foreign('item_id', strtolower('FItemObs_Item'))->references('item_id')->on('items')
                ->onDelete('restrict')->onUpdate("cascade");

            $table->foreign('user_id', strtolower('FItemObs_User'))->references('user_id')->on('users')
                ->onDelete('restrict')->onUpdate("cascade");

            $table->foreign('types_observation_id', strtolower('FItemObs_TypesObs'))
                ->references('types_observation_id')
                ->on('types_observation')
                ->onDelete('restrict')->onUpdate("cascade");

            $table->timestamps();
        });

        Schema::create('audiovisual_resource', function (Blueprint $table) {
            $table->increments('audiovisual_resource_id');

            $table->string('item_id', 40)->nullable();
            $table->string('item_observation_id', 40)->nullable();

            $table->text('resource');

            $table->timestamps();

            $table->foreign('item_observation_id', strtolower('FAudRes_ItemObs'))
                ->references("item_observation_id")
                ->on("item_observations")->onDelete("restrict")->onUpdate("cascade");

            $table->foreign('item_id', strtolower('FAudRes_Item'))->references("item_id")
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
