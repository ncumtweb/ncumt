<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();;
            $table->string('description');
            $table->string('image')->nullable();
            $table->date('bought_date')->nullable();
            $table->boolean('status')->default(0);
            $table->integer('size')->nullable();
            $table->integer('member_price');
            $table->integer('normal_price');
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
        Schema::dropIfExists('equipment');
    }
}
