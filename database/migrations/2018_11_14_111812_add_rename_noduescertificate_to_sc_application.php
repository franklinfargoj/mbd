<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRenameNoduescertificateToScApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sc_application', function (Blueprint $table) {
            $table->renameColumn('no_due_certificate', 'drafted_no_dues_certificate');
        });

        Schema::table('sc_application', function (Blueprint $table) {
            $table->string('text_no_dues_certificate')->after('drafted_no_dues_certificate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sc_application', function (Blueprint $table) {
            //
        });
    }
}
