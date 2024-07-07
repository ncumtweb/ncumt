<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentsToRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->comment = '租借記錄表';
            $table->unsignedBigInteger('user_id')->comment('租借者 ID')->change();
            $table->date('rental_date')->comment('租借日期')->change();
            $table->date('return_date')->comment('預計歸還日期')->change();
            $table->date('actual_return_date')->comment('實際歸還日期')->change();
            $table->integer('rental_amount')->comment('租借總金額')->change();
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
        Schema::table('rentals', function (Blueprint $table) {
            $table->comment = null;
            $table->unsignedBigInteger('user_id')->comment(null)->change();
            $table->date('rental_date')->comment(null)->change();
            $table->date('return_date')->comment(null)->change();
            $table->date('actual_return_date')->comment(null)->change();
            $table->integer('rental_amount')->comment(null)->change();
            $table->unsignedBigInteger('create_user')->nullable()->comment(null)->change();
            $table->unsignedBigInteger('modify_user')->nullable()->comment(null)->change();
        });
    }
}
