<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEoaApplicationProjectSheetWorkInHandDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eoa_application_project_sheet_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('eoa_application_id');
            $table->string('name_of_project')->nullable();
            $table->string('location')->nullable();
            $table->string('name_of_client')->nullable();
            $table->string('address')->nullable();
            $table->string('tel_no')->nullable();
            $table->string('built_up_area_in_sq_m')->nullable();
            $table->string('land_area_in_sq_m')->nullable();
            $table->string('estimated_value_of_project')->nullable();
            $table->string('completed_value_of_project')->nullable();
            $table->date('date_of_start')->nullable();
            $table->date('date_of_completion')->nullable();
            $table->string('whether_service_terminated_by_client')->nullable();
            $table->string('salient_features_of_project')->nullable();
            $table->string('reason_for_delay_if_any')->nullable();
            $table->tinyInteger('work_completed')->default(0);
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
        Schema::dropIfExists('eoa_application_project_sheet_work_in_hand_details');
    }
}
