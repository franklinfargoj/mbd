<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPropertyCardAreaColumnToLmVillageDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lm_village_detail', function (Blueprint $table) {
            $table->string('property_card_area')->after('property_card')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lm_village_detail', function (Blueprint $table) {
            $table->dropColumn('property_card_area');
        });
    }
}
