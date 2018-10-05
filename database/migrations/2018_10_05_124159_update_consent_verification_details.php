<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateConsentVerificationDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_consent_verification_details', function (Blueprint $table) {
            $table->integer('question_id')->change()->nullable();
            $table->integer('answer')->change()->nullable();
        });

        Schema::table('ol_demarcation_details', function (Blueprint $table) {
            $table->integer('question_id')->change()->nullable();
            $table->integer('answer')->change()->nullable();
        });         

        Schema::table('ol_rg_relocation_details', function (Blueprint $table) {
            $table->integer('question_id')->change()->nullable();
            $table->integer('answer')->change()->nullable();
        });         

        Schema::table('ol_tit_bit_details', function (Blueprint $table) {
            $table->integer('question_id')->change()->nullable();
            $table->integer('answer')->change()->nullable();
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
