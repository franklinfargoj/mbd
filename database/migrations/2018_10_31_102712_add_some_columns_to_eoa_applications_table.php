<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeColumnsToEoaApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eoa_applications', function (Blueprint $table) {
            $table->string('certificate_path')->nullable();
            $table->string('drafted_certificate')->nullable();
            $table->tinyInteger('final_signed_certificate_status')->default(0);
            $table->integer('application_status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eoa_applications', function (Blueprint $table) {
            $table->dropColumn('certificate_path');
            $table->dropColumn('drafted_certificate');
            $table->dropColumn('final_signed_certificate_status');
            $table->dropColumn('application_status');
        });
    }
}
