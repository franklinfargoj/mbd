<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploymentOfArchitectApplicationImportantProjectDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eoa_application_important_project_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('eoa_application_id');
            $table->string('name_of_client')->nullable();
            $table->string('location')->nullable();
            $table->string('category_of_client')->nullable();
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
        Schema::dropIfExists('eoa_application_important_project_details');
    }
}
