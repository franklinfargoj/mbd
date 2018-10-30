<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCopyOfAgreementToEoaApplicationProjectSheetDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eoa_application_project_sheet_details', function (Blueprint $table) {
            $table->string('copy_of_agreement')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eoa_application_project_sheet_details', function (Blueprint $table) {
            $table->dropColumn('copy_of_agreement');
        });
    }
}
