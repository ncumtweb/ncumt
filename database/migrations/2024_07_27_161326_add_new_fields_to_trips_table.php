<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->date('quit_date')->after('judgements_id')->comment('鳥隊日期');
            $table->string('quit_rule')->nullable()->after('quit_date')->comment('鳥隊規定');
            $table->integer('prepare_day')->default(0)->after('quit_rule')->comment('預備天天數');
            $table->text('additional_content')->nullable()->after('prepare_day')->comment('其他內容');
            $table->boolean('isActive')->default(false)->after('additional_content')->comment('是否開放報名');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->dropColumn('quit_date');
            $table->dropColumn('quit_rule');
            $table->dropColumn('prepare_day');
            $table->dropColumn('additional_content');
            $table->dropColumn('isActive');
        });
    }
}
