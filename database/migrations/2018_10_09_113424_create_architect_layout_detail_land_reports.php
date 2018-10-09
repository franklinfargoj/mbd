<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchitectLayoutDetailLandReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('architect_layout_detail_land_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('architect_layout_detail_id');
            $table->string('name_of_documents')->nullable();    
            $table->string('upload_file')->nullable();
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
        Schema::dropIfExists('architect_layout_detail_land_reports');
    }
}
