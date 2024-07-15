<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentsToEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipments', function (Blueprint $table) {
            $table->unsignedBigInteger('create_user')->nullable()->comment('建立者 ID');
            $table->unsignedBigInteger('modify_user')->nullable()->comment('更新者 ID');

            $table->comment = '裝備資訊表';
            $table->string('name', 255)->nullable()->comment('裝備種類：大背包、睡袋、睡墊 ...')->change();
            $table->string('description', 255)->comment('裝備簡介')->change();
            $table->string('image', 255)->nullable()->comment('圖片路徑')->change();
            $table->date('bought_date')->nullable()->comment('購買日期')->change();
            $table->smallInteger('status')->default(0)->comment('是否出租(0 = 未借出, 1 = 借出, 2 = 遺失)')->change();
            $table->integer('size')->nullable()->comment('裝備尺寸')->change();
            $table->integer('member_price')->comment('社員租借費用')->change();
            $table->integer('normal_price')->comment('非社員租借非用')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipments', function (Blueprint $table) {
            $table->dropColumn('create_user');
            $table->dropColumn('modify_user');
            $table->comment = null;
            $table->string('name', 255)->nullable()->comment(null)->change();
            $table->string('description', 255)->comment(null)->change();
            $table->string('image', 255)->nullable()->comment(null)->change();
            $table->date('bought_date')->nullable()->comment(null)->change();
            $table->smallInteger('status')->default(0)->comment(null)->change();
            $table->integer('size')->nullable()->comment(null)->change();
            $table->integer('member_price')->comment(null)->change();
            $table->integer('normal_price')->comment(null)->change();
        });
    }
}
