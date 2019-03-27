<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTalukaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taluka', function (Blueprint $table) {
            $table->increments('id');
            $table->string('taluka_name')->nullable();
            $table->integer('district_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('taluka', function($table) {

            $table->foreign('district_id')->references('id')->on('districts');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taluka');
    }
}
