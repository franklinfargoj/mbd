<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDeletedResolutions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deleted_resolutions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('resolution_id')->nullable();
            $table->unsignedInteger('resolution_type_id')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('filepath')->nullable();
            $table->string('filename')->nullable();
            $table->text('reason_for_delete')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('resolution_id')->references('id')->on('resolutions')->onDelete('cascade');
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
        Schema::dropIfExists('deleted_resolutions');
    }
}
