<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentsToRecordCommentRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('record_comment_replies', function (Blueprint $table) {
            $table->comment = '紀錄評論回覆表';
            $table->text('content')->comment('回覆內容')->change();
            $table->unsignedBigInteger('record_comment_id')->comment('評論 ID')->change();
            $table->unsignedBigInteger('record_id')->comment('記錄 ID')->change();
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
        Schema::table('record_comment_replies', function (Blueprint $table) {
            $table->comment = null;
            $table->text('content')->comment(null)->change();
            $table->unsignedBigInteger('record_comment_id')->comment(null)->change();
            $table->unsignedBigInteger('record_id')->comment(null)->change();
            $table->unsignedBigInteger('create_user')->nullable()->comment(null)->change();;
            $table->unsignedBigInteger('modify_user')->nullable()->comment(null)->change();;
        });
    }
}
