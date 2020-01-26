<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phone');
            $table->string('phone_footer');
            $table->string('office_hours');
            $table->string('office_hours_footer');
            $table->string('email');
            $table->text('about_footer');
            $table->string('location');
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('yelp')->nullable();
            $table->string('bbb')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
