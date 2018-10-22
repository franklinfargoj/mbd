<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploymentOfArchitectApplicationImpProjectWorkHandledDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eoa_application_imp_project_work_handled_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('eoa_application_imp_project_detail_id');
            $table->integer('no_of_dwelling')->nullable();
            $table->integer('land_area_in_sq_mt')->nullable();
            $table->integer('built_up_area_in_sq_mt');
            $table->integer('value_of_work_in_rs');
            $table->integer('year_of_completion_start');
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
        Schema::dropIfExists('eoa_application_imp_project_work_handled_details');
    }
}
