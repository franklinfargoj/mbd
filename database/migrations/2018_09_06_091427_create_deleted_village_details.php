<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeletedVillageDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deleted_village_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('village_details_id');
            $table->foreign('village_details_id')->references('id')->on('lm_village_detail')
                  ->onDelete('cascade');
            $table->string('user_name')->nullable();
            $table->string('land_name')->nullable();
            $table->string('day')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('change_file_name')->nullable();
            $table->string('reason')->nullable();
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
        Schema::dropIfExists('deleted_village_details');
    }
}
