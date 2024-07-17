<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leader_id')->comment('領隊 id');
            $table->integer('expected_cadre_count')->comment('預計幹部人數');
            $table->integer('expected_member_count')->comment('預計隊員人數');
            $table->string('name')->comment('隊伍名稱');
            $table->text('description')->comment('隊伍簡介');
            $table->smallInteger('category')->comment('隊伍分類');
            $table->date('start_date')->comment('隊伍開始日期');
            $table->date('end_date')->comment('隊伍結束日期');
            $table->string('image')->comment('封面圖片路徑');
            $table->decimal('expected_fee', 8, 2)->comment('預期隊費');
            $table->decimal('actual_fee', 8, 2)->nullable()->comment('實際隊費');
            $table->dateTime('registration_open')->comment('報名開始時間');
            $table->dateTime('registration_close')->comment('報名結束時間');
            $table->dateTime('pre_departure_time')->nullable()->comment('行前會時間');
            $table->integer('judgements_id')->comment('隊伍難度 id');
            $table->unsignedBigInteger('create_user')->nullable()->comment('建立者 ID');
            $table->unsignedBigInteger('modify_user')->nullable()->comment('更新者 ID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
