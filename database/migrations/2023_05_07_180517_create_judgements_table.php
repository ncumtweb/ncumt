<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJudgementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('judgements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('nomoal_day');
            $table->integer('abnomoal_day');
            $table->integer('level');
            $table->integer('road');
            $table->integer('terrain');
            $table->integer('plant');
            $table->integer('energy');
            $table->integer('water');
            $table->string('result_level');
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
        Schema::dropIfExists('judgements');
    }
}
