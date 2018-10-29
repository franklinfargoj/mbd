<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEoaApplicationIdToEoaApplicationImpProjectWorkHandledDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eoa_application_imp_project_work_handled_details', function (Blueprint $table) {
            $table->integer('eoa_application_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eoa_application_imp_project_work_handled_details', function (Blueprint $table) {
            $table->dropColumn('eoa_application_id');
        });
    }
}
