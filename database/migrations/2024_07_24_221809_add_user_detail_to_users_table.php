<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserDetailToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('department_level')->nullable()->comment('系級');
            $table->smallInteger('gender')->nullable()->comment('性別 0：男, 1：女');
            $table->smallInteger('altitude_sickness')->nullable()->comment('高山症 0：沒有, 1：輕微, 2：嚴重');
            $table->string('special_disease')->nullable()->comment('特殊疾病(加說明)');
            $table->smallInteger('dietary_habit')->nullable()->comment('葷素食調查 0：葷, 1：素, 2：蛋奶素');
            $table->string('favorite_foods')->nullable()->comment('喜歡的食物們');
            $table->string('allergic_foods')->nullable()->comment('過敏的食物們');
            $table->string('hate_foods')->nullable()->comment('討厭的食物們');
            $table->string('emergency_contact_person')->nullable()->comment('緊急聯絡人');
            $table->string('emergency_contact_relation')->nullable()->comment('與緊急聯絡人關係');
            $table->bigInteger('emergency_contact_phone')->nullable()->comment('緊急聯絡電話');
            $table->bigInteger('home_phone_number')->nullable()->comment('家裡電話');
            $table->string('home_address')->nullable()->comment('家裡住址');
            $table->integer('days_in_mountain')->default(0)->comment('在山上的天數');
            $table->integer('times_climbed_mountain')->default(0)->comment('爬山的次數');
            $table->time('five_kilograms_running_time')->nullable()->comment('五公里跑步時間');
            $table->dateTime('join_the_club_time')->nullable()->comment('加入登山社時間');
            $table->string('personal_id')->nullable()->unique()->comment('身分證字號');
            $table->smallInteger('guard')->nullable()->comment('0：非嚮導, 1：初嚮, 2：領嚮');
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
            $table->dropColumn('department_level');
            $table->dropColumn('gender');
            $table->dropColumn('altitude_sickness');
            $table->dropColumn('special_disease');
            $table->dropColumn('dietary_habit');
            $table->dropColumn('favorite_foods');
            $table->dropColumn('allergic_foods');
            $table->dropColumn('hate_foods');
            $table->dropColumn('emergency_contact_person');
            $table->dropColumn('emergency_contact_relation');
            $table->dropColumn('emergency_contact_phone');
            $table->dropColumn('home_phone_number');
            $table->dropColumn('home_address');
            $table->dropColumn('days_in_mountain');
            $table->dropColumn('times_climbed_mountain');
            $table->dropColumn('five_kilograms_running_time');
            $table->dropColumn('join_the_club_time');
            $table->dropColumn('personal_id');
            $table->dropColumn('guard');
        });
    }
}
