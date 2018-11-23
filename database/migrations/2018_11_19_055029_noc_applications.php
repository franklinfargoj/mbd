<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NocApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noc_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('language_id')->default(0); //  default 0
            $table->integer('society_id');
            $table->integer('application_master_id');
            $table->string('application_no');
            $table->string('application_path');
            $table->datetime('submitted_at');
            $table->integer('current_status_id');
            $table->integer('request_form_id');
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
        Schema::dropIfExists('noc_applications');
    }
}
