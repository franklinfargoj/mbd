<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLayoutNoToDefaultNullableInArchitectLayoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('architect_layouts', function (Blueprint $table) {
            $table->string('layout_no')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('architect_layouts', function (Blueprint $table) {
            $table->string('layout_no')->nullable(false)->change();
        });
    }
}
