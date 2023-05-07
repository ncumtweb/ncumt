<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnNameInJudgementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('judgements', function (Blueprint $table) {
            $table->renameColumn('nomoal_day', 'normal_day');
            $table->renameColumn('abnomoal_day', 'abnormal_day');
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
            $table->renameColumn('normoal_day', 'nomal_day');
            $table->renameColumn('abnormoal_day', 'abnomal_day');
        });
    }
}
