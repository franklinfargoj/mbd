<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocietyDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lm_society_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('society_name')->nullable();
            $table->string('district')->nullable();
            $table->string('taluka')->nullable();
            $table->string('village')->nullable();
            $table->string('survey_number')->nullable();
            $table->string('cts_number')->nullable();
            $table->string('chairman')->nullable();
            $table->string('society_address')->nullable();
            $table->string('area')->nullable();
            $table->string('date_on_service_tax')->nullable();
            $table->string('surplus_charges')->nullable();
            $table->string('surplus_charges_last_date')->nullable();

            $table->unsignedInteger('village_id');
            $table->foreign('village_id')->references('id')->on('lm_village_detail')->onDelete('cascade');

            $table->unsignedInteger('other_land_id');
            $table->foreign('other_land_id')->references('id')->on('other_land')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('society_detail');
    }
}
