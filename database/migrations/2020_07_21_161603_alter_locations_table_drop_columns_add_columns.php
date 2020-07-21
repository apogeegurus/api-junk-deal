<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLocationsTableDropColumnsAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn("facts_left");
            $table->dropColumn("facts_right");
            $table->dropColumn('police_address');
            $table->dropColumn('police_phone');
            $table->dropColumn('police_email');
            $table->dropColumn('donate_address');
            $table->dropColumn('donate_phone');


            $table->string("population");
            $table->string("average_age");
            $table->string("median_income");
            $table->string("median_home_value");
            $table->string("wiki_link");
            $table->string("address");
            $table->longText("what_to_eat");
            $table->longText("where_to_go");
            $table->string("city_emblem");
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
            $table->longText('facts_left');
            $table->longText('facts_right');

            $table->string('police_address');
            $table->string('police_phone');
            $table->string('police_email');
            $table->string('donate_address');
            $table->string('donate_phone');

            $table->dropColumn('city_emblem');
            $table->dropColumn("population");
            $table->dropColumn("average_age");
            $table->dropColumn("median_income");
            $table->dropColumn("median_home_value");
            $table->dropColumn("wiki_link");
            $table->dropColumn("address");
            $table->dropColumn("what_to_eat");
            $table->dropColumn("where_to_go");
        });
    }
}
