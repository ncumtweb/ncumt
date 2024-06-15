<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreateUserAndModifyUserToJudgementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('judgements', function (Blueprint $table) {
            $table->unsignedBigInteger('create_user')->nullable()->after('created_at'); // 假設 'id' 是表中的第一個欄位
            $table->unsignedBigInteger('modify_user')->nullable()->after('create_user');
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
            $table->dropColumn('create_user');
            $table->dropColumn('modify_user');
        });
    }
}
