<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'name_zh');
            $table->string('name_en', 20);
            $table->string('nickname', 10)->nullable();
            $table->string('phone', 100);
            $table->char('role', 1);
            $table->integer('token_tg', false)->length(20)->nullable();
            $table->integer('token_line', false)->length(20)->nullable();
            $table->dropColumn('email_verified_at');
            $table->dropColumn('password');
            $table->dropColumn('remember_token');
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
            $table->renameColumn('name_zh', 'name');
            $table->dropColumn('name_en');
            $table->dropColumn('nickname');
            $table->dropColumn('phone');
            $table->dropColumn('role');
            $table->dropColumn('token_tg');
            $table->dropColumn('token_line');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            
        });
    }
}
