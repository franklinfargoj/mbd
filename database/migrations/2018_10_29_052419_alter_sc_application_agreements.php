<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterScApplicationAgreements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('society_agrement_type_master');
        Schema::drop('sc_application_agreements');

        Schema::create('sc_agreement_type_master', function (Blueprint $table){
            $table->increments('id');
            $table->string('agreement_name')->nullable();
            $table->timestamps();             
        });

        Schema::create('sc_agreement_type_status', function (Blueprint $table){
            $table->increments('id');
             $table->integer('application_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('agreement_type_id')->nullable();
            $table->string('agreement_path')->nullable();
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
       Schema::dropIfExists('sc_agreement_type_master');
       Schema::dropIfExists('sc_agreement_type_status');
    }
}
