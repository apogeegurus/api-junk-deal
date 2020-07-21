<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYelpPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yelp_places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("img")->nullable();
            $table->string("rating")->nullable();
            $table->string("address")->nullable();
            $table->string("name")->nullable();
            $table->text("url")->nullable();
            $table->unsignedBigInteger("location_id");
            $table->foreign("location_id")->references("id")->on("locations")->onDelete("cascade");
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
        Schema::dropIfExists('yelp_places');
    }
}
