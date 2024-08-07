<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentsToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->comment = '公告資訊表';
            $table->integer('type')->comment('類型（0 = 隊伍, 1 ＝ 社課, 2 = 其他')->change();
            $table->smallInteger('pin')->default(0)->comment('是否置頂 (0 = 否, 1 = 是)')->change();
            $table->string('title', 50)->comment('標題')->change();
            $table->text('content')->comment('內容')->change();
            $table->datetime('expired_at')->comment('過期時間')->change();
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
        Schema::table('posts', function (Blueprint $table) {
            $table->comment = null;
            $table->integer('type')->comment(null)->change();
            $table->smallInteger('pin')->default(0)->comment(null)->change();
            $table->string('title', 50)->comment(null)->change();
            $table->text('content')->comment(null)->change();
            $table->datetime('expired_at')->comment(null)->change();
            $table->unsignedBigInteger('create_user')->nullable()->comment(null)->change();
            $table->unsignedBigInteger('modify_user')->nullable()->comment(null)->change();
        });
    }
}
