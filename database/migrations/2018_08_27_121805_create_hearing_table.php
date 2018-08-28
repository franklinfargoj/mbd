<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHearingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hearing', function (Blueprint $table) {
            $table->increments('id');
            $table->string('preceding_officer_name')->nullable();
            $table->string('case_year')->nullable();

            $table->unsignedInteger('application_type_id');
            $table->foreign('application_type_id')->references('id')->on('hearing_application_type')->onDelete('cascade');

            $table->string('applicant_name')->nullable();
            $table->string('applicant_mobile_no')->nullable();
            $table->longText('applicant_address')->nullable();

            $table->string('respondent_name')->nullable();
            $table->string('respondent_mobile_no')->nullable();
            $table->longText('respondent_address')->nullable();

            $table->string('case_type')->nullable();
            $table->string('office_year')->nullable();
            $table->string('office_number')->nullable();
            $table->string('office_date')->nullable();
            $table->string('office_tehsil')->nullable();
            $table->string('office_village')->nullable();
            $table->longText('office_remark')->nullable();

            $table->unsignedInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            $table->unsignedInteger('hearing_status_id');
            $table->foreign('hearing_status_id')->references('id')->on('hearing_status')->onDelete('cascade');

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
        Schema::dropIfExists('hearing');
    }
}
