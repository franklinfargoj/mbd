<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOlApplicationConcessionSheetDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ol_application_concession_sheet_details', function (Blueprint $table){
            $table->increments('id');
             $table->integer('application_id')->nullable();
             $table->integer('user_id')->nullable();
             $table->integer('society_id')->nullable();
            $table->text('tenement_charges')->nullable();
            $table->text('r_g_shiffting')->nullable();
            $table->text('ob_other_plot')->nullable();
            $table->text('vp_cota')->nullable();
            $table->text('encroachment_plot')->nullable();
            $table->text('premium_charges')->nullable();
            $table->text('tit_bit_land')->nullable();
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
        Schema::dropIfExists('ol_application_concession_sheet_details');
    }
}
