<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLocationGalleriesAddColumnHexCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('location_galleries', function (Blueprint $table) {
            $table->string("hex_code")->nullable();
            $table->string("file_name")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('location_galleries', function (Blueprint $table) {
            $table->dropColumn("hex_code");
            $table->string("file_name")->change();
        });
    }
}
