<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEoaApplicationImpSeniorProfessionalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eoa_application_imp_senior_professional_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('eoa_application_id');
            $table->string('category')->nullable();
            $table->string('name')->nullable();
            $table->string('qualifications')->nullable();
            $table->string('year_of_qualification')->nullable();
            $table->string('len_of_service_with_firm_in_year')->nullable();
            $table->string('len_of_service_with_firm_in_month')->nullable(); 
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
        Schema::dropIfExists('eoa_application_imp_senior_professional_details');
    }
}
