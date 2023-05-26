<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('title', 50);
            $table->string('videoURL')->nullable();
            $table->string('pptURL')->nullable();
            $table->string('image');
            $table->longText('description');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('VideoURL');
            $table->string('pptURL');
            $table->dropColumn('image');
            $table->dropColumn('description');
        });
    }
}
