<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterHomeTableAddColumnStepsGallery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->string('step_one')->nullable();
            $table->string('step_two')->nullable();
            $table->string('step_three')->nullable();
            $table->string('animation_back')->nullable();
            $table->string('animation_front')->nullable();
            $table->string('animation_truck')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->dropColumn('step_one');
            $table->dropColumn('step_two');
            $table->dropColumn('step_three');
            $table->dropColumn('animation_back');
            $table->dropColumn('animation_front');
            $table->dropColumn('animation_truck');
        });
    }
}
