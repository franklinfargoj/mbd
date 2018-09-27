<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillageSocietiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('village_societies', function (Blueprint $table) {
            $table->integer('village_id')->unsigned();
            $table->integer('society_id')->unsigned();

            $table->foreign('village_id')->references('id')->on('lm_village_detail')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('society_id')->references('id')->on('lm_society_detail')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['village_id', 'society_id']);
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
        Schema::dropIfExists('village_societies');
    }
}
