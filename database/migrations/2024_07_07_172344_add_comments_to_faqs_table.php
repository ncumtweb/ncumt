<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentsToFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->comment = 'QA 紀錄表'; // Table comment
            $table->string('question')->comment('問題')->change();
            $table->longText('answer')->comment('答案')->change();
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
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn('create_user');
            $table->dropColumn('modify_user');
            $table->comment = null;
            $table->string('question')->comment(null)->change();
            $table->longText('answer')->comment(null)->change();
        });
    }
}
