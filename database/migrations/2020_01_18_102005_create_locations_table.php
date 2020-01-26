<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('city');
            $table->string('title');
            $table->string('sub_title');
            $table->longText('description');
            $table->longText('facts_left');
            $table->longText('facts_right');
            $table->string('website');
            $table->string('city_phone');
            $table->string('police_address');
            $table->string('police_phone');
            $table->string('police_email');
            $table->string('donate_address');
            $table->string('donate_phone');
            $table->string('weather')->nullable();
            $table->string('weather_icon')->nullable();
            $table->string('main_image');
            $table->string('banner_first');
            $table->string('banner_second');
            $table->string('lat');
            $table->string('lon');
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
        Schema::dropIfExists('locations');
    }
}
