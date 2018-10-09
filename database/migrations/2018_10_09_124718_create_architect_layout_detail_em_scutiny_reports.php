<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchitectLayoutDetailEmScutinyReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('architect_layout_detail_em_scrutiny_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('architect_layout_id');
            $table->string('name_of_document')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('architect_layout_detail_em_scrutiny_reports');
    }
}
