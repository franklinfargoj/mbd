<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OlTitBitSimulationValuesMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ol_tit_bit_simulation_values_master', function (Blueprint $table){
            $table->increments('id');
             $table->integer('language_id')->nullable();
             $table->string('group')->nullable();
            $table->text('values')->nullable();
             $table->tinyInteger('is_deleted')->default(0);
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
        Schema::dropIfExists('ol_tit_bit_simulation_values_master');
    }
}
