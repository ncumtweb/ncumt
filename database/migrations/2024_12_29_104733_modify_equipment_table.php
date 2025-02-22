<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ModifyEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipments', function (Blueprint $table) {
            // Rename the column 'number' to 'category_oid'
            $table->renameColumn('number', 'equipment_oid');

            // Add the new 'weight' column
            $table->integer('weight')->nullable()->comment('裝備重量（克）')->after('normal_price');
        });

        DB::statement("ALTER TABLE `equipments` MODIFY COLUMN `equipment_oid` INT COMMENT '裝備編號 by 裝備種類'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipments', function (Blueprint $table) {
            // Rename 'category_oid' back to 'number'
            $table->renameColumn('equipment_oid', 'number');

            // Remove the 'weight' column
            $table->dropColumn('weight');
        });
    }
}
