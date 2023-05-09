<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewCloumnJudgements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('judgements', function (Blueprint $table) {
            $table->integer('score');
            $table->string('result_level')->nullable(false)->change();
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
            $table->dropColumn('score');
            $table->string('result_level')->nullable()->change();
        });
    }
}
