<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNoDuesCertificateInTextFormatSfApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sf_applications', function (Blueprint $table) {
            $table->string('no_dues_certificate_in_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sf_applications', function (Blueprint $table) {
            $table->dropColumn('no_dues_certificate_in_text');
        });
    }
}
