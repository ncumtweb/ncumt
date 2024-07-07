<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentsToRentalEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rental_equipment', function (Blueprint $table) {
            $table->comment = '裝備租借紀錄對應表';
            $table->integer('equipment_id')->comment('裝備 ID')->change();
            $table->integer('rental_id')->comment('租借紀錄 ID')->change();
            $table->unsignedBigInteger('create_user')->nullable()->comment('建立者 ID');
            $table->unsignedBigInteger('modify_user')->nullable()->comment('更新者 ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rental_equipment', function (Blueprint $table) {
            $table->comment = null;
            $table->integer('equipment_id')->comment(null)->change();
            $table->integer('rental_id')->comment(null)->change();
            $table->unsignedBigInteger('create_user')->nullable()->comment(null)->change();
            $table->unsignedBigInteger('modify_user')->nullable()->comment(null)->change();
        });
    }
}
