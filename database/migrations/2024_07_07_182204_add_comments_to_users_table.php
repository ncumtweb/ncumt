<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->comment = '使用者表';
            $table->string('identifier')->nullable()->comment('學號')->change();
            $table->string('name_zh')->comment('中文名稱')->change();
            $table->string('email')->comment('電子信箱')->change();
            $table->string('name_en')->comment('英文名字')->change();
            $table->string('nickname')->nullable()->comment('暱稱')->change();
            $table->string('phone')->nullable()->comment('手機')->change();
            $table->integer('role')->default(0)->comment('角色')->change();
            $table->integer('token_tg')->nullable()->comment('Telegram Token')->change();
            $table->integer('token_line')->nullable()->comment('LINE Token')->change();
            $table->string('remember_token')->nullable()->comment('Remember Token')->change();
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
        Schema::table('users', function (Blueprint $table) {
            $table->comment = null;
            $table->string('identifier')->nullable()->comment(null)->change();
            $table->string('name_zh')->comment(null)->change();
            $table->string('email')->comment(null)->change();
            $table->string('name_en')->comment(null)->change();
            $table->string('nickname')->nullable()->comment(null)->change();
            $table->string('phone')->nullable()->comment(null)->change();
            $table->integer('role')->default(0)->comment(null)->change();
            $table->integer('token_tg')->nullable()->comment(null)->change();
            $table->integer('token_line')->nullable()->comment(null)->change();
            $table->string('remember_token')->nullable()->comment(null)->change();
            $table->unsignedBigInteger('create_user')->nullable()->comment(null)->change();
            $table->unsignedBigInteger('modify_user')->nullable()->comment(null)->change();
        });
    }
}
