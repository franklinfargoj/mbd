<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillageDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lm_village_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('board_id');
            $table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');

            $table->string('sr_no')->nullable();
            $table->string('village_name')->nullable();

            $table->unsignedInteger('land_source_id');
            $table->foreign('land_source_id')->references('id')->on('land_source')->onDelete('cascade');

            $table->string('land_address')->nullable();
            $table->string('district')->nullable();
            $table->string('taluka')->nullable();
            $table->string('total_area')->nullable();
            $table->string('possession_date')->nullable();
            $table->longText('remark')->nullable();
            $table->boolean('7_12_extract')->comment('1=upload and 0= not upload')->nullable();
            $table->boolean('7_12_mhada_name')->nullable();
            $table->string('property_card')->nullable();
            $table->boolean('property_card_mhada_name')->nullable();
            $table->string('land_cost')->nullable();
            $table->string('extract_file_path')->nullable();
            $table->string('extract_file_name')->nullable();
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
        Schema::dropIfExists('village_detail');
    }
}
