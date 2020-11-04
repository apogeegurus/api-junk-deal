<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLocationsTableAddColumnAlts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->string("alt_main")->nullable();
            $table->string("alt_city_emblem")->nullable();
            $table->string("alt_banner_first")->nullable();
            $table->string("alt_banner_second")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('alt_main');
            $table->dropColumn('alt_city_emblem');
            $table->dropColumn('alt_banner_first');
            $table->dropColumn('alt_banner_second');
        });
    }
}
