<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnDatatypeInRtiForwardApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rti_forward_application', function (Blueprint $table) {
            $table->string('remarks')->nullable()->change();
            $table->integer('department_id')->unsigned()->nullable()->change();
            $table->integer('board_id')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rti_forward_application', function (Blueprint $table) {
            $table->string('remarks')->nullable(false)->change();
            $table->integer('department_id')->unsigned()->nullable(false)->change();
            $table->integer('board_id')->unsigned()->nullable(false)->change();
        });
    }
}
