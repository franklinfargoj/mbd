<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeColumnsInTheLmSocietyDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lm_society_detail', function (Blueprint $table) {
            $table->tinyInteger('is_conveyanced')->default(0);
            $table->decimal('lease_and_na_charges_in_per',10,2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lm_society_detail', function (Blueprint $table) {
            $table->dropColumn('is_conveyanced');
            $table->dropColumn('lease_and_na_charges_in_per');
        });
    }
}
