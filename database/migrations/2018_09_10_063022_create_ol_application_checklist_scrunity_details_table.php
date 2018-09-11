<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOlApplicationChecklistScrunityDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ol_application_checklist_scrunity_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id');
            $table->integer('user_id'); //processing employee id
            $table->enum('verification_type', ['CONSENT VERIFICATION', 'DEMARCATION', 'TIT BIT', 'RG RELOCATION']); // the "option" type... maybe
            $table->string('layout');
            $table->string('details_of_notice')->nullable();
            $table->string('investigation_officer_name');
            $table->date('date_of_investigation');
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
        Schema::dropIfExists('ol_application_checklist_scrunity_details');
    }
}
