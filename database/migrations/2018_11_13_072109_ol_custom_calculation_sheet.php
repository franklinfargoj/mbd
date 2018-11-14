<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OlCustomCalculationSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ol_custom_calculation_sheet', function (Blueprint $table){
            $table->increments('id');
            $table->integer('application_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('title')->nullable();
            $table->string('amount')->nullable();
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
       Schema::dropIfExists('ol_custom_calculation_sheet');
    }
}
