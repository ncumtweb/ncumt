<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConferenceUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conference_users', function (Blueprint $table) {
            $table->id()->comment('主鍵');
            $table->string('name')->comment('姓名'); // 姓名
            $table->boolean('is_vegetarian')->default(false)->comment('是否吃素 0：否, 1：是'); // 是否吃素
            $table->smallInteger('gender')->comment('性別 0：男, 1：女');
            $table->string('phone')->comment('手機'); // 手機
            $table->string('email')->unique()->comment('電子郵件'); // Email
            $table->enum('identity', ['student', 'social'])->comment('參加身份（學生/社會人士）'); // 參加身份
            $table->string('school_name')->nullable()->comment('校名'); // 校名
            $table->string('department')->nullable()->comment('系級'); // 系級
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conference_users');
    }
}
