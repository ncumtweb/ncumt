<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentsToRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('records', function (Blueprint $table) {
            $table->comment = '隊伍記錄表';
            $table->string('name')->comment('路線名稱')->change();
            $table->string('image')->comment('圖片路徑')->change();
            $table->text('content')->comment('紀錄內容')->change();
            $table->smallInteger('category')->comment('種類（0 = 中級山, 1 = 高山, 2 = 溯溪）')->change();
            $table->date('start_date')->comment('開始日期')->change();
            $table->date('end_date')->comment('結束日期')->change();
            $table->longText('description')->comment('路線簡介')->change();
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
        Schema::table('records', function (Blueprint $table) {
            $table->string('name')->comment(null)->change();
            $table->string('image')->comment(null)->change();
            $table->text('content')->comment(null)->change();
            $table->smallInteger('category')->comment(null)->change();
            $table->date('start_date')->comment(null)->change();
            $table->date('end_date')->comment(null)->change();
            $table->longText('description')->comment(null)->change();
            $table->unsignedBigInteger('create_user')->nullable()->comment(null)->change();
            $table->unsignedBigInteger('modify_user')->nullable()->comment(null)->change();
        });
    }
}
