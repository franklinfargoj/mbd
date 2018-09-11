<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeletedHearingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deleted_hearing', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hearing_id')->nullable();
            $table->string('case_number')->nullable();
            $table->string('case_year')->nullable();
            $table->string('appellant_name')->nullable();
            $table->longText('description')->nullable();
            $table->string('final_judgement')->nullable();
            $table->longText('delete_reason')->nullable();
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
        Schema::dropIfExists('deleted_hearing');
    }
}
