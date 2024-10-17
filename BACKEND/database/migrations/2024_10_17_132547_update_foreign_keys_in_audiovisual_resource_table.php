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
         // Drop and re-add the first foreign key
         DB::statement('ALTER TABLE `audiovisual_resource` DROP FOREIGN KEY `faudres_item`');
         DB::statement('ALTER TABLE `audiovisual_resource` ADD CONSTRAINT `faudres_item` FOREIGN KEY (`item_id`) REFERENCES `items`(`item_id`) ON DELETE CASCADE ON UPDATE CASCADE');
         
         // Drop and re-add the second foreign key
         DB::statement('ALTER TABLE `audiovisual_resource` DROP FOREIGN KEY `faudres_itemobs`');
         DB::statement('ALTER TABLE `audiovisual_resource` ADD CONSTRAINT `faudres_itemobs` FOREIGN KEY (`item_observation_id`) REFERENCES `item_observations`(`item_observation_id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
           // Revert the first foreign key change
           DB::statement('ALTER TABLE `audiovisual_resource` DROP FOREIGN KEY `faudres_item`');
           DB::statement('ALTER TABLE `audiovisual_resource` ADD CONSTRAINT `faudres_item` FOREIGN KEY (`item_id`) REFERENCES `items`(`item_id`)');
   
           // Revert the second foreign key change
           DB::statement('ALTER TABLE `audiovisual_resource` DROP FOREIGN KEY `faudres_itemobs`');
           DB::statement('ALTER TABLE `audiovisual_resource` ADD CONSTRAINT `faudres_itemobs` FOREIGN KEY (`item_observation_id`) REFERENCES `item_observations`(`item_observation_id`)');
    }
};
