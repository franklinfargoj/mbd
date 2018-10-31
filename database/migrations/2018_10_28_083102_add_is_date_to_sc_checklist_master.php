<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsDateToScChecklistMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sc_checklist_master', function (Blueprint $table) {
            $table->tinyInteger('is_date')->after('name')->default('0');
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sc_checklist_master', function (Blueprint $table) {
            $table->dropColumn('is_date');
        });
    }
}
