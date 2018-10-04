<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDraftedCertificateToArchitectApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('architect_application', function (Blueprint $table) {
            $table->string('drafted_certificate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('architect_application', function (Blueprint $table) {
            $table->dropColumn('drafted_certificate');
        });
    }
}
