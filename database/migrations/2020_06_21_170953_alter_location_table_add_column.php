<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLocationTableAddColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->string("url")->nullable()->unique();
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->string("map_address")->nullable();
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
            $table->dropColumn("url");
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn("map_address");
        });
    }
}
