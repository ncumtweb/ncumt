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
            $table->unique('email', 'users_email_unique');
            $table->dropColumn('login_method');
            $table->dropColumn('river_guard');
            $table->dropUnique('users_student_id_unique');
            $table->renameColumn('student_id', 'identifier');
        });
    }
}
