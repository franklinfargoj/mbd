<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLayoutNameColumnDatatypeToIntegerArchitectLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('architect_layouts', function (Blueprint $table) {
            $table->integer('layout_name')->default(0)->change();
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
            $table->dropColumn('layout_name');
        });
    }
}
