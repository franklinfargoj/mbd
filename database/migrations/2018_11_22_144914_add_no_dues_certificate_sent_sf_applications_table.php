<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNoDuesCertificateSentSfApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sf_applications', function (Blueprint $table) {
            $table->tinyInteger('no_dues_certificate_sent_to_society')->default(0);
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
            $table->dropColumn('no_dues_certificate_sent_to_society');
        });
    }
}
