<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentsToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            // Add comments to existing columns
            $table->comment = '行事曆活動記錄表';
            $table->string('title')->comment('活動名稱')->change();
            $table->datetime('start')->comment('開始時間')->change();
            $table->datetime('end')->comment('結束時間')->change();
            $table->integer('category')->comment('活動種類（0 = 出隊, 1 = 溯溪, 2 = 社課, 3 = 討論, 4 = 山防')->change();
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
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('create_user');
            $table->dropColumn('modify_user');
            $table->comment = null;
            $table->string('title')->comment(null)->change();
            $table->datetime('start')->comment(null)->change();
            $table->datetime('end')->comment(null)->change();
            $table->integer('category')->comment(null)->change();
        });
    }
}
