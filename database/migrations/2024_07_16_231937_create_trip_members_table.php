<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_members', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id')->comment('隊員 id');
            $table->integer('trips_id')->comment('隊伍 id');
            $table->integer('role')->comment('職位（0: 隊員, 1: 公文, 2: 菜單, 3: 總務, 4: 器材, 5: 紀錄, 6: 保險, 7: 交通, 8: 入山, 9:採買, 10: 醫藥, 11: 氣象）');
            $table->unsignedBigInteger('create_user')->nullable()->comment('建立者 ID');
            $table->unsignedBigInteger('modify_user')->nullable()->comment('更新者 ID');
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
        Schema::dropIfExists('trip_members');
    }
}
