<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConveyanceTypeColumnInTheLmSocietyDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lm_society_detail', function (Blueprint $table) {
            $table->string('conveyanced_type')->nullable();
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
            $table->drop('conveyanced_type');
        });
    }
}
