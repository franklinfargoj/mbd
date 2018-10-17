<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterConveyanceChecklistScrutiny extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conveyance_checklist_scrutiny', function (Blueprint $table) {
           $table->string('registration_date')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conveyance_checklist_scrutiny', function (Blueprint $table) {
            $table->dropColumn('registration_date');
        });
    }
}
