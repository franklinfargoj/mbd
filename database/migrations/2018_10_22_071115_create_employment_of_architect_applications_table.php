<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploymentOfArchitectApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eoa_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_of_panel')->nullable();
            $table->string('name_of_applicant')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('pin')->nullable();
            $table->string('mobile')->nullable();
            $table->string('off')->nullable();
            $table->string('fax')->nullable();
            $table->string('res')->nullable();
            
            $table->string('details_of_establishment')->nullable();
            $table->string('branch_office_details')->nullable();

            $table->string('staff_architects')->nullable();
            $table->string('staff_engineers')->nullable();
            $table->string('staff_supporting_tech')->nullable();
            $table->string('staff_supporting_nontech')->nullable();
            $table->string('staff_others')->nullable();
            $table->string('staff_total')->nullable();

            $table->tinyInteger('is_cad_facility')->default(0);
            $table->string('cad_facility_no_of_operators')->nullable();
            $table->string('cad_facility_no_of_computers')->nullable();
            $table->string('cad_facility_no_of_printers')->nullable();
            $table->string('cad_facility_no_of_plotters')->nullable();

            $table->string('reg_with_council_of_architecture_principle')->nullable();
            $table->string('reg_with_council_of_architecture_associate')->nullable();
            $table->string('reg_with_council_of_architecture_partner')->nullable();
            $table->string('reg_with_council_of_architecture_total_registered_persons')->nullable();
            $table->string('award_prizes_etc')->nullable();
            $table->string('other_information')->nullable();
            
            $table->tinyInteger('application_info_and_its_enclosures_verify')->default(0);
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
        Schema::dropIfExists('eoa_applications');
    }
}
