<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUploadedNoduescertificateToScApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sc_application', function (Blueprint $table) {
            $table->string('uploaded_no_dues_certificate')->nullable()->after('text_no_dues_certificate');
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
