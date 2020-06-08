<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterHomePageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_pages', function (Blueprint $table) {
            $table->text('title')->change();
            $table->text('sub_title')->change();
            $table->text('specialize_title')->change();
            $table->text('banner_one_text')->change();
            $table->text('banner_two_text')->change();
            $table->text('how_it_works_title')->change();
            $table->text('how_it_works_sub_title')->change();
            $table->text('step_1_text')->change();
            $table->text('step_2_text')->change();
            $table->text('step_3_text')->change();
            $table->text('video_title')->change();
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
            $table->string('title')->change();
            $table->string('sub_title')->change();
            $table->string('specialize_title')->change();
            $table->string('banner_one_text')->change();
            $table->string('banner_two_text')->change();
            $table->string('how_it_works_title')->change();
            $table->string('how_it_works_sub_title')->change();
            $table->string('step_1_text')->change();
            $table->string('step_2_text')->change();
            $table->string('step_3_text')->change();
            $table->string('video_title')->change();
        });
    }
}
