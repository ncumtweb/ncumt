<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentsToCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedBigInteger('create_user')->nullable()->comment('建立者 ID');
            $table->unsignedBigInteger('modify_user')->nullable()->comment('更新者 ID');

            $table->comment = '社課資訊表，紀錄社課詳細資訊';
            $table->string('title', 50)->comment('標題')->change();
            $table->string('videoURL', 255)->nullable()->comment('影片 URL')->change();
            $table->string('pptURL', 255)->nullable()->comment('PPT URL')->change();
            $table->string('image', 255)->comment('圖片路徑')->change();
            $table->date('date')->comment('社課日期')->change();
            $table->string('speaker', 255)->comment('講者')->change();
            $table->string('location', 255)->comment('地點')->change();
            $table->text('description')->comment('社課簡介')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('create_user');
            $table->dropColumn('modify_user');
            $table->string('title', 50)->comment(null)->change();
            $table->string('videoURL', 255)->nullable()->comment(null)->change();
            $table->string('pptURL', 255)->nullable()->comment(null)->change();
            $table->string('image', 255)->comment(null)->change();
            $table->date('date')->comment(null)->change();
            $table->string('speaker', 255)->comment(null)->change();
            $table->string('location', 255)->comment(null)->change();
            $table->text('description')->comment(null)->change();
            $table->comment = null;
        });
    }
}
