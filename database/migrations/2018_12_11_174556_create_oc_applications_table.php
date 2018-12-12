<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOcApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oc_applications', function (Blueprint $table) {
            $table->increments('id');
                $table->integer('language_id')->default(0); //  default 0
                $table->integer('society_id');
                $table->integer('application_master_id');
                $table->string('application_no');
                $table->string('application_path');
                $table->datetime('submitted_at');
                $table->integer('current_status_id');
                $table->string('name_of_architect')->nullable();
                $table->string('architect_mobile_no')->nullable();
                $table->string('architect_telephone_no')->nullable();
                $table->string('architect_address')->nullable();
                $table->date('date_of_site_visit')->nullable();
                $table->string('site_visit_officers')->nullable(); // comma separated names
                $table->string('oc_path')->nullable();
                $table->tinyInteger('is_approve_oc'); //0 => no, 1 => yes
                $table->string('drafted_oc')->nullable();
                $table->string('text_oc')->nullable();
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
        Schema::dropIfExists('oc_applications');
    }
}
