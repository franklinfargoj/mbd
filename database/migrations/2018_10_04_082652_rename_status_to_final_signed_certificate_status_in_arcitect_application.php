<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameStatusToFinalSignedCertificateStatusInArcitectApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('architect_application', function(Blueprint $table) {
            $table->dropColumn('status');
            $table->tinyInteger('final_signed_certificate_status')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('architect_application', function(Blueprint $table) {
            $table->tinyInteger('status')->default('0');
            $table->dropColumn('final_signed_certificate_status');
        });
    }
}
