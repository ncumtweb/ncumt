<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_email_unique');
            $table->boolean('has_long_experience')->default(false)->nullable()->comment('是否有長程經驗');
            $table->boolean('has_river_experience')->default(false)->nullable()->comment('是否有溯溪經驗');
            $table->string('login_method')->nullable()->comment('登入方式');
            $table->smallInteger('river_guard')->default(0)->comment('0：非溪嚮, 1：溪嚮');
            $table->renameColumn('identifier', 'student_id');
            $table->unique('student_id', 'users_student_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('has_long_experience');
            $table->dropColumn('has_river_experience');
            $table->dropColumn('login_method');
            $table->dropColumn('river_guard');
            $table->dropUnique('users_student_id_unique');
            $table->renameColumn('student_id', 'identifier');
        });
    }
}
