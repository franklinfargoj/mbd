<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OlDemarcationLandArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ol_demarcation_land_area', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('lease_agreement_area')->nullable();          
            $table->string('​​staggering_plot_area')->nullable();          
            $table->string('tit_bit_area')->nullable();          
            $table->string('rg_plot_area')->nullable();          
            $table->string('pg_plot_area')->nullable();          
            $table->string('road_setback_area')->nullable();          
            $table->string('encroachment_area')->nullable();          
            $table->string('another_area')->nullable();          
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
        Schema::dropIfExists('ol_demarcation_land_area');        
    }
}
