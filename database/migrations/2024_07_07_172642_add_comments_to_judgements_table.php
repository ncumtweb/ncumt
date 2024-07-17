<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentsToJudgementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('judgements', function (Blueprint $table) {
            // Comments for the table
            $table->comment = '隊伍難度評分表';
            $table->string('name')->comment('隊伍名稱')->change();
            $table->integer('normal_day')->comment('傳統路天數')->change();
            $table->integer('abnormal_day')->comment('非傳統路天數')->change();
            $table->integer('level')->comment('路況分級')->change();
            $table->integer('road')->comment('路跡級別')->change();
            $table->integer('terrain')->comment('地形級別')->change();
            $table->integer('plant')->comment('植被級別')->change();
            $table->integer('energy')->comment('體力級別')->change();
            $table->integer('water')->comment('多背水天數')->change();
            $table->string('result_level')->comment('難度等級')->change();
            $table->integer('score')->comment('難度總分')->change();
            $table->integer('trip_tag')->default(0)->comment('行程（0 = 一般行程, 1 = 壓縮行程, 2 = 寬鬆行程')->change();
            $table->unsignedBigInteger('create_user')->nullable()->comment('建立者 ID')->change();
            $table->unsignedBigInteger('modify_user')->nullable()->comment('更新者 ID')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('judgements', function (Blueprint $table) {
            $table->comment = null;
            $table->string('name')->comment(null)->change();
            $table->integer('normal_day')->comment(null)->change();
            $table->integer('abnormal_day')->comment(null)->change();
            $table->integer('level')->comment(null)->change();
            $table->integer('road')->comment(null)->change();
            $table->integer('terrain')->comment(null)->change();
            $table->integer('plant')->comment(null)->change();
            $table->integer('energy')->comment(null)->change();
            $table->integer('water')->comment(null)->change();
            $table->string('result_level')->comment(null)->change();
            $table->integer('score')->comment(null)->change();
            $table->integer('trip_tag')->comment(null)->change();
            $table->unsignedBigInteger('create_user')->comment(null)->change();
            $table->unsignedBigInteger('modify_user')->comment(null)->change();
        });
    }
}
