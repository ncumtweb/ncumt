<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentsToCourseRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_records', function (Blueprint $table) {
            $table->comment = '社課登記表，紀錄有誰報名過社課';
            $table->unsignedBigInteger('user_id')->comment('使用者 ID')->change();
            $table->unsignedBigInteger('course_id')->comment('社課 ID')->change();
            $table->unsignedBigInteger('create_user')->after('updated_at')->nullable()->comment('建立者 ID');
            $table->unsignedBigInteger('modify_user')->after('create_user')->nullable()->comment('更新者 ID');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_records', function (Blueprint $table) {
            // Remove added columns
            $table->dropColumn('create_user');
            $table->dropColumn('modify_user');

            // Remove comments
            $table->unsignedBigInteger('user_id')->comment(null)->change();
            $table->unsignedBigInteger('course_id')->comment(null)->change();
            $table->timestamp('created_at')->nullable()->comment(null)->change();
            $table->timestamp('updated_at')->nullable()->comment(null)->change();
            $table->comment = null;
        });
    }
}
