<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResolutions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resolutions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('board_id')->nullable();
            $table->unsignedInteger('department_id')->nullable();
            $table->unsignedInteger('resolution_type_id')->nullable();
            $table->string('resolution_code')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('filepath')->nullable();
            $table->string('filename')->nullable();
            $table->string('language')->nullable();
            $table->string('reference_link')->nullable();
            $table->date('published_date')->nullable();
            $table->text('revision_log_message')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('resolution_type_id')->references('id')->on('resolution_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resolutions');
    }
}
